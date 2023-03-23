<?php
/*
 * space-tactics-php8
 * BuildingsController.php | 1/31/23, 9:34 PM
 * Copyright (C)  2023 ShaoKhan
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace App\Controller;

use App\Repository\BuildingsRepository;
use App\Repository\PlanetRepository;
use App\Repository\PlanetTypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends AbstractController
{
    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(
        ManagerRegistry      $managerRegistry,
        PlanetRepository     $p,
        PlanetTypeRepository $ptr,
        BuildingsRepository  $br,
                             Security $security,
                             $slug = NULL,
    ): Response
    {
        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getAllPlayerPlanets($managerRegistry, $user_uuid);
        $firstPlanet = array_search($slug, array_column($planets, 'slug'));
        $selectedPlanet = $planets[$firstPlanet];

        if ($slug === NULL) {
            $selectedPlanet = $planets[0];
        }

        $built = $p->getPlanetBuildings($user_uuid, $selectedPlanet, $managerRegistry);

        dd($built);

        return $this->render('buildings/index.html.twig', [
            'planets' => $planets,
            'selectedPlanet' => $selectedPlanet,
            'user' => $this->getUser(),
            'slug' => $slug,
            'buildings' => $built ?? NULL,
        ]);
    }

    public function getBuildingProduction(string $buildingName, int $level, array $factor, float $planetTemp): array
    {
        switch ($buildingName) {
            case 'metal_building':
                $prod = (30 * $level * pow((1.1), $level)) * (0.1 * $factor[0]->getFactor());
                $costEnergy = -(10 * $level * pow((1.1), $level)) * (0.1 * $factor[0]->getFactor());
                break;
            case 'crystal_building':
                $prod = (20 * $level * pow((1.1), $level)) * (0.1 * $factor[0]->getFactor());
                $costEnergy = -(10 * $level * pow((1.1), $level)) * (0.1 * $factor[0]->getFactor());
                break;
            case 'deuterium_building':
                $prod = (10 * $level * pow((1.1), $level) * (-0.002 * $planetTemp + 1.28) * (0.1 * $factor[0]->getFactor()));
                $costEnergy = -(30 * $level * pow((1.1), $level)) * (0.1 * $factor[0]->getFactor());
                break;
            default:
                $prod = 0.0;
                $costEnergy = 0.0;
                break;
        }
        return ['production' => $prod, 'costEnergy' => $costEnergy];
    }

    public function getMetalCosts($factor, $level)
    {
        return $factor[0]->getCostMetal() * pow($factor[0]->getFactor(), $level);
    }

    public function getCrystalCosts($factor, $level)
    {
        return $factor[0]->getCostCrystal() * pow($factor[0]->getFactor(), $level);
    }

    public function getDeuteriumCosts($factor, $level)
    {
        return $factor[0]->getCostDeuterium() * pow($factor[0]->getFactor(), $level);
    }

    private function BuildingMapping(): array
    {

        $buildingMap = [
            1 => 'metal_building',
            2 => 'crystal_building',
            3 => 'deuterium_building',
            4 => 'solar_building',
            5 => 'university_building',
            6 => 'nuclear_building',
            7 => 'robot_building',
            8 => 'nanite_building',
            9 => 'hangar_building',
            10 => 'metalstorage_building',
            11 => 'crystalstorage_building',
            12 => 'deuteriumstorage_building',
            13 => 'laboratory_building',
            14 => 'terraforming_building',
            15 => 'alliancehangar_building',
            16 => 'moonbase_building',
            17 => 'missilesilo_building',
            18 => 'jumpgate_building',
            19 => 'laserphalanx_building',

        ];

        return $buildingMap;
    }

}
