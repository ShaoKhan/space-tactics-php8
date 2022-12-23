<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends AbstractController
{
    #[Route('/buildings/{planetID?}', name: 'buildings')]
    public function index(ManagerRegistry $managerRegistry, $planetID = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet = $this->getPlanets($managerRegistry, $planetID);

        return $this->render('buildings/index.html.twig', [
            'user'           => $this->getUser(),
            'selectPlanets'  => $planet['selectPlanets'],
            'selectedPlanet' => $planetID,
            'planets'        => $planet['planets'],
            'planetData'     => $planet['planetData'],
        ]);
    }
}
