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
declare(strict_types = 1);

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\PlanetTypeRepository;
use App\Service\BuildingCalculationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends AbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(
        Request                    $request,
        ManagerRegistry            $managerRegistry,
        PlanetRepository           $p,
        Security                   $security,
        PlanetTypeRepository       $planetTypeRepository,
        BuildingCalculationService $bcs,
                                   $slug = NULL,
    ): Response
    {

        //ToDo: populate tables

        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $this->user_uuid, $slug);
        $built = $p->getPlanetBuildings($this->user_uuid, $planets[1], $managerRegistry);
        $i = 0;

        foreach($built as $building) {
            $nextLevelProd = $bcs->calculateNextBuildingLevelProduction($building) * 3600;
            $nextLevelBuildCost = $bcs->calculateNextBuildingCosts($building);
            $nextLevelEnergyCost = $bcs->calculateNextBuildingLevelEnergyCosts($building) * 3600;


            $built[$i]['production'] = number_format($nextLevelProd, 0, ',', '.');
            $built[$i]['nextEnergyCosts'] = number_format($nextLevelEnergyCost, 0, ',', '.');
            $built[$i]['BuildCosts'] = $nextLevelBuildCost;
            $i++;
        }




        return $this->render(
            'buildings/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'slug'           => $slug,
            #'buildings' => $built ?? NULL,
        ],
        );
    }

}
