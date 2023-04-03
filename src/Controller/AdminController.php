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
use App\Form\ServerType;
use App\Repository\ServerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

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


}
