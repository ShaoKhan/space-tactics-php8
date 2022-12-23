<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends AbstractController
{
    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(ManagerRegistry $managerRegistry, $slug = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet = $this->getPlanets($managerRegistry, $slug);

        return $this->render('buildings/index.html.twig', [
            'user'           => $this->getUser(),
            'selectPlanets'  => $planet['selectPlanets'],
            'selectedPlanet' => $slug,
            'planets'        => $planet['planets'],
            'planetData'     => $planet['planetData'],
        ]);
    }
}
