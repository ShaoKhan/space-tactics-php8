<?php

namespace App\Controller;

use App\Entity\Server;
use App\Form\ServerType;
use App\Form\Type\UserType;
use App\Repository\ServerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin_server', name: 'admin_server')]
    public function server(
        ValidatorInterface $validator, Request $request,
        ManagerRegistry    $doctrine,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $server       = new Server();
        $errorsString = NULL;
        $errors       = $validator->validate($server);
        $servername   = [];
        #$this->session->getFlashBag()->clear();
        $form = NULL;

        $repo       = $doctrine->getRepository(Server::class);
        $servername = $repo->findAll();

        if($servername[0] === null) {
            $form = $this->createForm(ServerType::class, $server, [
                'action' => $this->generateUrl('admin_server'),
            ]);

            if(count($errors) > 0) {
                $errorsString = (string)$errors;
            }

            $form->handleRequest($request);
            if($form->isSubmitted()) {

                if($form->isValid()) {
                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($form->getData());
                    $entityManager->flush();
                    $this->session->getFlashBag()->add('success', 'Dein Server wurde angelegt.');
                } else {
                    $this->session->getFlashBag()->add('error', 'Bei der Erstellung des Servers ist ein Fehler aufgetreten.');
                }
            }
        }

        return $this->render('admin/server.html.twig', [
            'controller_name' => 'AdminController',
            'form'            => $form,
            'errors'          => $errorsString,
            'server'          => $servername,
        ]);
    }

}
