<?php
/*
 * space-tactics-php8
 * BuildingsController.php | 1/28/23, 9:20 PM
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
                             $slug = NULL,
    ): Response
    {
        $userid = $this->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet = $this->getPlanets($managerRegistry, $slug);

        $built = $p->getPlanetBuildings($userid, $planet["selectedPlanet"][0]->getSlug(), $managerRegistry);
        $buildings = $this->BuildingMapping();
        foreach ($buildings as $key => $value) {
            $level = $p->getLevelByName($value, $planet["selectedPlanet"][0]->getSlug())[0]['level'] ?? 1;



            $price = $br->getBuildingPrice($key);
            $planetType = $ptr->findBy(['type' => $planet["selectedPlanet"][0]->getType()]);
            $planetTemp = ($planetType[0]->getTempMin() + $planetType[0]->getTempMax()) / 2;
            $production = $this->getBuildingProduction($value, $level, $price, $planetTemp);
            $built[$key] = [
                'type' => $value,
                'level' => $level,
                'image' => $price[0]->getImage() ?? 'planets/6.jpg',
                'price' => [
                    'metal' => number_format($this->getMetalCosts($price, $level), 0, ',', '.'),
                    'crystal' => number_format($this->getCrystalCosts($price, $level), 0, ',', '.'),
                    'deuterium' => number_format($this->getDeuteriumCosts($price, $level) * 60 * 60, 0, ',', '.'),
                ],
                'production' => number_format($production['production'] * 60 * 60, 0, ',', '.') . ' pro Stunde',
                'costEnergy' => $production['costEnergy']
            ];

        }
        unset($built[0]);

        $planet["selectedPlanet"] = $planet["selectedPlanet"][0];
        $planet["darkmatter"] = $p->getDarkmatter($userid)[0]['darkmatter'];

        return $this->render('buildings/index.html.twig', [
            'planets' => $planet,
            'user' => $this->getUser(),
            'slug' => $slug,
            'buildings' => $built ?? NULL,
        ]);
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

}
