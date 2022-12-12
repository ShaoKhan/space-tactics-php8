<?php

namespace App\Controller;

use App\Entity\Server;
use App\Form\ServerType;
use App\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin_server', name: 'admin_server')]
    public function server()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(ServerType::class, new Server(), [
            'action' => $this->generateUrl('admin_server'),
        ]);


        return $this->render('admin/server.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form,
        ]);
    }

}
