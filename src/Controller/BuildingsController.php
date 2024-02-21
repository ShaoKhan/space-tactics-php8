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

use App\Entity\BuildingsQueue;
use App\Entity\Planet;
use App\Repository\BuildingsQueueRepository;
use App\Repository\BuildingsRepository;
use App\Repository\PlanetBuildingRepository;
use App\Repository\PlanetRepository;
use App\Repository\UniRepository;
use App\Service\BuildingCalculationService;
use App\Service\BuildingDependencyChecker;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class BuildingsController extends CustomAbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    /**
     * @throws Exception
     */
    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(
        ManagerRegistry            $managerRegistry,
        PlanetRepository           $p,
        PlanetBuildingRepository   $pb,
        BuildingsRepository        $br,
        BuildingCalculationService $bcs,
        Security                   $security,
        BuildingDependencyChecker  $buildingDependencyChecker,
        BuildingsQueueRepository   $bqr,
        UniRepository              $uniRepository,
                                   $slug = NULL,
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        if($slug === null) {
            throw new \Exception('planet slug is null');
        }

        $planets        = $this->getPlanetsByPlayer($managerRegistry, $this->user, $slug);
        $uni            = $uniRepository->findOneBy(['id' => 1]);
        $planet         = $p->findOneBy(['user_uuid' => $this->user->getUuid(), 'slug' => $slug]);
        $actualPlanetId = $planets[1]->getId();
        $buildings      = $br->findAll(); //buildings repository
        $buildingList   = [];
        $buildingQueue  = $bqr->findBy(['planet' => $planet]);

        foreach($buildingQueue as $buildQueue) {

            $startDateTime           = new DateTime();
            $endDateTime             = new DateTime($buildQueue->getEndBuild()->format('Y-m-d H:i:s'));
            $timeDifferenceInSeconds = $endDateTime->getTimestamp() - $startDateTime->getTimestamp();

            if($timeDifferenceInSeconds >= 0) {
                $buildingList[] = [
                    'buildingId' => $buildQueue->getBuilding()->getSlug(),
                    'name'       => $buildQueue->getBuilding()->getName(),
                    'start'      => $buildQueue->getStartBuild()->format('Y-m-d H:i:s'),
                    'end'        => $buildQueue->getEndBuild()->format('Y-m-d H:i:s'),
                    'timeLeft'   => $timeDifferenceInSeconds,
                ];
            }
        }

        foreach($buildings as $building) {
            $planetBuildings = $pb->findBy(['planet_id' => $actualPlanetId, 'building_id' => $building->getId()]);

            if(!empty($building)) {
                $building->setIsBuildable($buildingDependencyChecker->canConstructBuilding($building->getId(), $security->getUser(), $actualPlanetId));
                $building->nextLevelProd       = $bcs->calculateNextBuildingLevelProduction($building->getId(), $actualPlanetId, $managerRegistry) * 3600;
                $building->nextLevelBuildCost  = $bcs->calculateNextBuildingCosts($building->getId(), $actualPlanetId, $managerRegistry);
                $building->nextLevelEnergyCost = $bcs->calculateNextBuildingLevelEnergyCosts($building->getId(), $actualPlanetId, $managerRegistry) * 3600;
                $building->obfuscated          = base64_encode($building->getSlug() . getenv('OBFUSCATE_SECRET'));
                if($planetBuildings) {
                    $building->level = $planetBuildings[0]?->getBuildingLevel();
                }
            }
        }
        $prodActual = $bcs->calculateActualBuildingProduction($planet->getMetalBuilding(), $planet->getCrystalBuilding(), $planet->getDeuteriumBuilding(), $managerRegistry);
        return $this->render(
            'buildings/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'slug'           => $slug,
            'buildings'      => $buildings,
            'production'     => $prodActual,
            'buildList'      => $buildingList,
            'maxQueue'       => $uni->getMaxConstructionCount(),
        ],
        );
    }


    /**
     * @param Request                $request
     * @param PlanetRepository       $p
     * @param EntityManagerInterface $em
     * @param null                   $slug
     *
     * @return JsonResponse
     * @throws Exception
     */

    #[Route('/saveResource/{slug?}', name: 'save-resource')]
    public function saveResource(
        Request                $request,
        PlanetRepository       $p,
        EntityManagerInterface $em,
                               $slug = NULL,
    ): JsonResponse
    {
        if($slug === null) {
            throw new Exception('planet slug is null - can\'t save resources.');
        }

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

    /**
     * @throws Exception
     */
    #[Route('/startConstruction', name: 'start-construction')]
    public function startConstruction(
        Request                    $request,
        Security                   $security,
        BuildingsRepository        $buildingsRepository,
        BuildingsQueueRepository   $buildingsQueueRepository,
        PlanetRepository           $planetRepository,
        PlanetBuildingRepository   $planetBuildingRepository,
        TranslatorInterface        $translator,
        BuildingCalculationService $bcs,
        ManagerRegistry            $managerRegistry,
        UniRepository              $uniRepository,
        EntityManagerInterface     $em,

    ): Response
    {

        //check if resources are available [done]
        //check if building is buildable by dependency [done before (not visible if not buildable)]
        //check if queue is empty or not full [done]
        // check if building is already in queue [done]
        //start construction [done]
        //update planet resources
        //ToDo: create cronjob to remove from building queue and update energy resources
        $successMessages = [];
        $errorMessages   = [];
        $user            = $security->getUser();
        $planetId        = $request->request->get('planetId');
        $buildingId      = $request->request->get('buildingId');
        $status          = true;

        $actualBuildingData = $planetBuildingRepository->findOneBy(['planet_slug' => $planetId, 'building_slug' => $buildingId]);
        $buildingData       = $buildingsRepository->findOneBy(['slug' => $buildingId]);
        $planet             = $planetRepository->findOneBy(['slug' => $planetId]);
        $uni                = $uniRepository->findOneBy(['id' => $user->getUni()]);

        $metalOnPlanet     = $planet->getMetal();
        $crystalOnPlanet   = $planet->getCrystal();
        $deuteriumOnPlanet = $planet->getDeuterium();

        //build once ?
        if($buildingData->isOnePerPlanet() && $actualBuildingData->getBuildingLevel() >= 1) {
            $errorMessages[] = $translator->trans('only_one_per_planet', [], 'buildings');
            $status          = false;
        }

        //enough resources ?
        $buildCosts = $bcs->calculateNextBuildingCosts($buildingData->getId(), $planet->getId(), $managerRegistry);
        if(($metalOnPlanet < $buildCosts["metal"]) || ($crystalOnPlanet < $buildCosts["crystal"]) || ($deuteriumOnPlanet < $buildCosts["deuterium"])) {
            $errorMessages[] = $translator->trans('not_enough_resources', [], 'buildings');
            $status          = false;
        }

        // building queue is full
        $queue = $buildingsQueueRepository->findBy(['planet' => $planet]);
        if(count($queue) >= $uni->getMaxConstructionCount()) {
            $errorMessages[] = $translator->trans('building_queue', [], 'buildings');
            $status          = false;
        }

        //check if building is already in queue
        foreach($queue as $building) {
            if($building->getBuilding()->getId() === $actualBuildingData->getId()) {
                $errorMessages[] = $translator->trans('already_in_queue', [], 'buildings');
                $status          = false;
            }
        }

        if($status !== false) {
            //calculate new resources
            $newMetal     = $metalOnPlanet - $buildCosts["metal"];
            $newCrystal   = $crystalOnPlanet - $buildCosts["crystal"];
            $newDeuterium = $deuteriumOnPlanet - $buildCosts["deuterium"];
            $planet->setMetal($newMetal)->setCrystal($newCrystal)->setDeuterium($newDeuterium);

            //calculate build time
            $start        = new DateTime();
            $secondsToAdd = (int)(($buildCosts["metal"] + $buildCosts["crystal"] + $buildCosts["deuterium"]) / ($uni->getGameSpeed() * (1 + $planet->getRobotBuilding())) * pow(0.5, $planet->getNaniteBuilding()) * (1 + $uni->getMinBuildTime()) / 60);
            $end          = (clone $start)->add(new DateInterval('PT' . $secondsToAdd . 'S'));

            $buildingQueue = new BuildingsQueue();
            $buildingQueue->setBuilding($buildingData);
            $buildingQueue->setPlanet($planet);
            $buildingQueue->setStartBuild($start);
            $buildingQueue->setEndBuild($end);
            $buildingQueue->setUserSlug($planet->getUserUuid());
            $em->persist($buildingQueue);
            $em->persist($planet);
            $em->flush();

            $successMessages[] = 'Das folgende Gebäude wurde in die Warteschlange eingereiht: ';

        }

        return new JsonResponse(
            [
                'successMessages' => $successMessages,
                'errorMessages'   => $errorMessages,
                'building'        => $translator->trans($buildingData->getName(), [], 'buildings'),
                'end'             => $end ?? null,
            ],
        );
    }

}
