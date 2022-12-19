<?php

namespace App\Controller;

use App\Entity\Planet;
use App\Entity\Uni;
use App\Entity\User;
use App\Repository\PlanetRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class MainController extends AbstractController
{

    private User    $user;

    public function __construct(
        User $user,
        Planet $planet,
        Uni $universe,
    )
    {
        $this->user = $user;


    }

    #[Route('/main', name: 'main')]
    public function index(#[CurrentUser] ?User $user, ManagerRegistry $managerRegistry): Response
    {
        $user = $this->getUser();
        $planet = new PlanetRepository($managerRegistry);
        $planetData = $planet->findBy(['user_uuid' => $user->getUserIdentifier()]);
        dd($planetData);




        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('main/index.html.twig', [
            'username' => $user->getUserIdentifier()
        ]);
    }
}
