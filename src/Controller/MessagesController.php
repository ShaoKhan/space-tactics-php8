<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    #[Route('/messages/{slug?}', name: 'messages')]
    public function index(
        Security           $security,
        ManagerRegistry    $managerRegistry,
        MessagesRepository $messagesRepository,
                           $slug = NULL,
    ): Response
    {

        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        $form = $this->createForm(MessagesType::class, new Messages());

        $messages = $messagesRepository->findBy(['to_uuid' => $user_uuid]);

        return $this->render(
            'messages/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'user'           => $this->getUser(),
            'messages'       => $messages,
            'form'           => $form->createView(),
            'slug'           => $slug,
        ],
        );
    }
}
