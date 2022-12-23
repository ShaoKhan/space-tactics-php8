<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/main/{slug?}', name: 'main')]
    public function index(ManagerRegistry $managerRegistry, $slug = NULL): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet = $this->getPlanets($managerRegistry, $slug);

        return $this->render('main/index.html.twig', [
            'user'           => $this->getUser(),
            'selectPlanets'  => $planet['selectPlanets'],
            'selectedPlanet' => $slug,
            'planets'        => $planet['planets'],
            'planetData'     => $planet['planetData'],
        ]);
    }
}
