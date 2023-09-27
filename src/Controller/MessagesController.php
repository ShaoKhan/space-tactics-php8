<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use App\Service\CheckMessagesService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

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
        Request                $request,
        Security               $security,
        ManagerRegistry        $managerRegistry,
        MessagesRepository     $messagesRepository,
        EntityManagerInterface $em,
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
            $message->setWasRead(TRUE);
            $message->setAnswered(TRUE);

            $messageTo = $form->getData();
            $messageTo->setFromUuid($message->getToUuid());
            $messageTo->setFromName($message->getToName());
            $messageTo->setToUuid($message->getFromUuid());
            $messageTo->setToName($message->getFromName());
            $messageTo->setSendDate(new \DateTime());
            $messageTo->setMessageType($message->getMessageType());
            $messageTo->setSubject('Re: ' . $message->getSubject());
            $messageTo->setWasRead(FALSE);
            $messageTo->setAnswered(FALSE);
            $messageTo->setDeleted(FALSE);
            $messageTo->setSlug($this->generateUuid());

            $em->persist($messageTo);
            $em->flush();
        }


        return $this->render(
            'messages/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'form'           => $form->createView(),
            'slug'           => $slug,
        ],
        );
    }

    #[Route('/messages/delete/{slug}', name: 'message_delete')]
    public function message_delete(
        $slug,
        MessagesRepository $messagesRepository,
        EntityManagerInterface $em,
    ):Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $message = $messagesRepository->findOneBy(['slug' => $slug]);
        $message->setDeleted(TRUE);
        $em->persist($message);
        $em->flush();

        return $this->redirectToRoute('messages');
    }

}
