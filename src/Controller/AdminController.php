<?php
/*
 * space-tactics-php8
 * AdminController.php | 1/12/23, 11:17 PM
 * Copyright (C)  2023 ShaoKhan
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Controller;

use App\Entity\Server;
use App\Entity\Support;
use App\Form\ServerType;
use App\Form\SupportAnswerType;
use App\Repository\BuildingsQueueRepository;
use App\Repository\PlanetBuildingRepository;
use App\Repository\ServerRepository;
use App\Repository\SupportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class AdminController extends AbstractController
{

    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(
            'admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ],
        );
    }

    #[Route('/admin_server', name: 'admin_server')]
    public function server(
        ServerRepository $serverRepository,
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $server = $serverRepository->findAll();

        return $this->render(
            'admin/server.html.twig',
            [
                'server' => $server,
            ],
        );
    }

    #[Route('/admin_server_add', name: 'admin_server_add')]
    public function server_add(
        Request                $request,
        EntityManagerInterface $entityManager,

    ): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ServerType::class, new Server());
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->session->getFlashBag()->add('success', 'Dein Server wurde angelegt.');

            $this->redirect('/admin_server');
        }

        return $this->render(
            'admin/server_add.html.twig', [
            'form' => $form->createView(),
        ],
        );
    }

    #[Route('/admin_support', name: 'admin_support')]
    public function adminSupport(
        SupportRepository      $supportRepository,
        Request                $request,
        Security               $security,
        EntityManagerInterface $em,
    ): Response
    {
        //ToDo: Es werden nur nicht geschlossene Tickets angezeigt.
        //      Evtl. sollte hier die Möglichkeit einer Suche gegeben sein, die auch bereits geschlossene Tickets findet.

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $support = $supportRepository->findBy(['closed' => 0]);

        $groupedMessages = [];
        foreach($support as $message) {
            $parentId = $message->getParentMessage();
            if(!isset($parentId)) {
                $groupedMessages[$message->getId()] = [
                    'question' => $message,
                    'answers'  => [],
                ];
            }
            else {
                $groupedMessages[$parentId]['answers'][] = $message;
            }
        }

        $form = $this->createForm(SupportAnswerType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $user      = $security->getUser();
            $old       = $supportRepository->findOneBy(['slug' => $form->get('ticketId')->getData()]);
            $newTicket = new Support();

            $newTicket->setUuid($user->getUuid())
                      ->setDatum(new \DateTime())
                      ->setSubject('RE: ' . $old->getSubject())
                      ->setTheme($old->getTheme())
                      ->setMessage($form->get('message')->getData())
                      ->setProcessedBy($user->getUsername())
                      ->setProcessedSince(new \DateTime())
                      ->setAnswered(1)
                      ->setClosed(0)
                      ->setParentMessage($old->getId())
                      ->setUsername($user->getUsername())
                      ->setSlug(Uuid::v4())
            ;

            $em->persist($newTicket);
            $em->flush();
        }

        return $this->render(
            'admin/support/support.html.twig', [
            'groupedMessages' => $groupedMessages,
            'form'            => $form->createView(),
        ],
        );
    }

    #[Route('/admin_support_delete/{slug}', name: 'admin_support_delete')]
    public function adminSupportDelete(
        SupportRepository      $supportRepository,
        EntityManagerInterface $em,
                               $slug,
    ): Response
    {
        #$supportRepository->remove($supportRepository->find($slug), TRUE);
        $ticket = $supportRepository->findOneBy(['slug' => $slug]);
        $ticket->setClosed(1);
        $em->persist($ticket);
        $em->flush();

        return $this->redirect('/admin_support');
    }

    #[Route('/cron_construction', name: 'cronjob_construction')]
    public function buildingQueue(
        BuildingsQueueRepository $buildingsQueueRepository,
        PlanetBuildingRepository $planetBuildingRepository,
        EntityManagerInterface   $em,
    ): JsonResponse
    {
        $date          = new \DateTime();
        $buildingQueue = $buildingsQueueRepository->findAll();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        foreach($buildingQueue as $key => $building) {
            if($building->getEndBuild() <= $date) {

                $planet   = $building->getPlanet();
                $building = $building->getBuilding();

                $planetBuildings = $planetBuildingRepository->findOneBy(['planet_id' => $planet->getId(), 'building_id' => $building->getId()]);
                $planetBuildings->setBuildingLevel($planetBuildings->getBuildingLevel() + 1);
                $em->remove($buildingQueue[$key]);
                $em->persist($planetBuildings);
                $em->flush();
            }
        }

        return new JsonResponse(['status' => 'success']);

    }

}
