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

use App\Entity\Planet;
use App\Repository\PlanetRepository;
use App\Service\BuildingCalculationService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends CustomAbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(
        Request                    $request,
        ManagerRegistry            $managerRegistry,
        PlanetRepository           $p,
        BuildingCalculationService $bcs,
        Security                   $security,
                                   $slug = NULL,
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $planets    = $this->getPlanetsByPlayer($managerRegistry, $this->user_uuid, $slug);
        $res        = $p->findOneBy(['user_uuid' => $this->user_uuid, 'slug' => $slug]);
        $prodActual = $bcs->calculateActualBuildingProduction($res->getMetalBuilding(), $res->getCrystalBuilding(), $res->getDeuteriumBuilding(), $managerRegistry);

        $built = $p->getPlanetBuildings($this->user_uuid, $planets[1], $managerRegistry);
        $i     = 0;
        foreach($built as $building) {
            $nextLevelProd       = $bcs->calculateNextBuildingLevelProduction($building) * 3600;
            $nextLevelBuildCost  = $bcs->calculateNextBuildingCosts($building);
            $nextLevelEnergyCost = $bcs->calculateNextBuildingLevelEnergyCosts($building) * 3600;


            $built[$i]['production']      = number_format($nextLevelProd, 0, ',', '.');
            $built[$i]['nextEnergyCosts'] = number_format($nextLevelEnergyCost, 0, ',', '.');
            $built[$i]['BuildCosts']      = $nextLevelBuildCost;
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
            'buildings'      => $built ?? NULL,
            'production'     => $prodActual,
        ],
        );
    }


    /**
     * @param Request                $request
     * @param PlanetRepository       $p
     * @param EntityManagerInterface $em
     * @param                        $slug
     *
     * @return JsonResponse|void
     *
     * TODO: Refactor this to a service BUT need improvements:
     *                          - the resources should not be updated by last saved time
     *                          - i dont get resource updates after logout for a day and login again .... resources only counts when logged in at this time
     */

    #[Route('/saveResource/{slug?}', name: 'save-resource')]
    public function saveResource(
        Request                $request,
        PlanetRepository       $p,
        EntityManagerInterface $em,
                               $slug = NULL,
    ): JsonResponse
    {
        if($slug !== NULL) {
            $data = json_decode($request->getContent(), true);

            $referer = $request->headers->get('referer');
            $referer = explode('/', $referer);
            $slug    = end($referer);

            /** @var Planet $planet */
            $planet = $p->findOneBy(['slug' => $slug]);
            $planet->setMetal(intval($data['amountMetal']));
            $planet->setCrystal(intval($data['amountCrystal']));
            $planet->setDeuterium(intval($data['amountDeuterium']));
            $planet->setLastUpdate(new \DateTime());
            $em->persist($planet);
            $em->flush();

            return new JsonResponse($data);
        }
        else {
            dd('slug is null');
        }
    }
}
