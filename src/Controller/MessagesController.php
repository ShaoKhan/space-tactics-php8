<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use App\Service\CheckMessagesService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{

    public function __construct(
        CheckMessagesService $checkMessagesService,
        Security             $security,
        ManagerRegistry      $managerRegistry,
    )
    {
        parent::__construct($checkMessagesService, $security, $managerRegistry);
    }


    #[Route('/messages/{slug?}', name: 'messages')]
    public function index(
        Request            $request,
        Security           $security,
        ManagerRegistry    $managerRegistry,
        MessagesRepository $messagesRepository,
                           $slug = NULL,
    ): Response
    {

        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);
        $form    = $this->createForm(MessagesType::class, new Messages());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $message = $messagesRepository->findOneBy(['slug' => $form->getData()->getSlug()]);
            $message->setWasRead(true);
            $message->setAnswered(true);

            /** @var Messages $messageTo */
            $messageTo->setMessage('test');

//            $messageTo->setFromUuid($message->getToUuid());
//            $messageTo->setFromName($message->getToName());
//            $messageTo->setToUuid($message->getFromUuid());
//            $messageTo->setFromName($message->getFromUuid());
//            $messageTo->setMessage($form->getData()->getMessage());




            dd($message, $messageTo);

        }


        return $this->render(
            'messages/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'user'           => $this->getUser(),
            'messages'       => $this->messages,
            'form'           => $form->createView(),
            'slug'           => $slug,
        ],
        );
    }
}
