<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\ScienceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShipyardController extends AbstractController
{
    #[Route('/shipyard/{slug?}', name: 'shipyard')]
    public function index(
        ManagerRegistry  $managerRegistry,
        PlanetRepository $p,
        ScienceRepository $sr,
        Security         $security,
        $slug = NULL,
    ): Response
    {
        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        if($slug === NULL) {
            $selectedPlanet = $planets[0];
            $slug           = $selectedPlanet["slug"];
        }

        return $this->render('shipyard/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'user'           => $this->getUser(),
            'slug'           => $slug,
        ]);
    }
}
