<?php
/*
 * ShaoKhan
 * Copyright (C)  2023 ShaoKhan
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Controller;

use App\Entity\Planet;
use App\Repository\BuildingsRepository;
use App\Repository\DependenciesRepository;
use App\Repository\PlanetRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends AbstractController
{
    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(
        ManagerRegistry        $managerRegistry,
        DependenciesRepository $dp,
        BuildingsRepository    $br,
        PlanetRepository       $p,
        $slug = NULL,
    ): Response {
        $pl = new Planet();
        $userid = $this->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet    = $this->getPlanets($managerRegistry, $slug);
        $buildings = $pl->getAllBuildings();

        $planet["selectedPlanet"] = $planet["selectedPlanet"][0];
        $planet["darkmatter"] = $p->getDarkmatter($userid)[0]['darkmatter'];

        return $this->render('buildings/index.html.twig', [
            'planets'   => $planet,
            'user'      => $this->getUser(),
            'slug'      => $slug,
            'buildings' => $buildings ?? NULL,
        ]);
    }

    private function BuildingMapping(): array
    {

        $buildingMap = [
            1  => 'metal_building',
            2  => 'crystal_building',
            3  => 'deuterium_building',
            4  => 'solar_building',
            5  => 'nuclear_building',
            6  => 'robot_building',
            7  => 'nanite_building',
            8  => 'hangar_building',
            9  => 'metalstorage_building',
            10 => 'crystalstorage_building',
            11 => 'deuteriumstorage_building',
            12 => 'laboratory_building',
            13 => 'university_building',
            14 => 'alliancehangar_building',
            15 => 'missilesilo_building',
            16 => 'missilelauncher_defense',
        ];

        return $buildingMap;
    }

}
