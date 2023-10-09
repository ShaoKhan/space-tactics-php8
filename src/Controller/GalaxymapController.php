<?php
/*
 * space-tactics-php8
 * GalaxymapController.php | 1/26/23, 9:07 PM
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
use App\Repository\PlanetRepository;
use App\Repository\UniRepository;
use App\Repository\UserRepository;
use App\Service\BuildingCalculationService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalaxymapController extends CustomAbstractController
{
    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/galaxymap/{slug?}', name: 'galaxymap')]
    public function index(
        Request                    $request,
        ManagerRegistry            $managerRegistry,
        PlanetRepository           $p,
        BuildingCalculationService $bcs,
        UniRepository              $ur,
        Security                   $security,
                                   $slug = NULL,

    ): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $this->user_uuid, $slug);
        $res = $p->findOneBy(['user_uuid' => $this->user_uuid, 'slug' => $slug]);
        $prodActual = $bcs->calculateActualBuildingProduction($res->getMetalBuilding(), $res->getCrystalBuilding(), $res->getDeuteriumBuilding(), $managerRegistry);

        $uniDimensions = $ur->getUniDimensions()[0];

        if($request->get('slug') !== NULL) {
            $slug = $request->get('slug');
        }

        if($uniDimensions["galaxy_width"] <= 50 && $uniDimensions["galaxy_height"] <= 50) {
            $uniDimensions['itemsize'] = 27;
            $uniDimensions['break'] = 50;

        }
        elseif($uniDimensions["galaxy_width"] <= 100 && $uniDimensions["galaxy_height"] <= 100) {
            $uniDimensions['itemsize'] = 13;
            $uniDimensions['break'] = 100;
        }
        elseif($uniDimensions["galaxy_width"] <= 200 && $uniDimensions["galaxy_height"] <= 200) {
            $uniDimensions['itemsize'] = 6.7;
            $uniDimensions['break'] = 200;
        }
        else {
            $uniDimensions['itemsize'] = 0;
            $uniDimensions['break'] = 0;
        }

        $coords = $p->getAllCoords();

        return $this->render(
            'galaxymap/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'dimensions'     => $uniDimensions,
            'coords'         => $coords,
            'slug'           => $slug,
            'production'     => $prodActual,
        ],
        );
    }

    #[Route('/system-info', name: 'system-info')]
    public function ajaxGetSystemInfo(
        Request                $request,
        EntityManagerInterface $emi,
        PlanetRepository       $p,
        UserRepository         $ur,
    ): JsonResponse
    {

        if(!$request->isXmlHttpRequest()) {

            return new JsonResponse(
                [
                    'status'  => 'Error',
                    'message' => 'no xmlHttpRequest',
                ],
                400,
            );
        }

        if(isset($request->request)) {

            $x = intval($request->request->get('x'));
            $y = intval($request->request->get('y'));

            $planet = $p->findBy(
                [
                    'system_x' => $x,
                    'system_y' => $y,
                ],
            );

            $planets = [];
            foreach($planet as $playerPlanet) {

                $user = $ur->findOneBy(
                    [
                        'uuid' => $playerPlanet->getUserUuid(),
                    ],
                );

                $planets[] = [
                    'id'    => $user->getUuid(),
                    'name'  => $playerPlanet->getName(),
                    'user'  => $user->getUsername(),
                    'z'     => $playerPlanet->getSystemZ(),
                    'pslug' => $playerPlanet->getSlug(),
                ];
            }

            if($planets !== NULL) {

                return new JsonResponse(
                    [
                        'status'  => 'success',
                        'user'    => $p->getUserUuid(),
                        'message' => $planets,
                    ],
                    200,
                );
            }
        }

        return new JsonResponse(
            [
                'status'  => 'Error',
                'message' => 'empty request',
            ],
            400,
        );

    }

    #[Route('/galaxymap/addFriend', name: 'galaxymap_addfriend')]
    public function addFriend(
        UserRepository  $userRepo,
        ManagerRegistry $emi,
    ): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $srcId = $this->getUser()->getUuid();

        if(isset($request->request)) {
            $targetId = $request->request->get('slug');
        }

        if($userRepo->addFriend($srcId, $targetId, $emi)) {
            return new JsonResponse(
                [
                    'status'  => 'success',
                    'message' => 'Friend added',
                ],
                200,
            );
        }
        else {
            return new JsonResponse(
                [
                    'status'  => 'Error',
                    'message' => 'Friend not added',
                ],
                400,
            );
        }
    }
}
