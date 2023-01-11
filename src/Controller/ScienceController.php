<?php

namespace App\Controller;

use App\Entity\Planet;
use App\Repository\PlanetRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScienceController extends AbstractController
{
    #[Route('/science/{slug?}', name: 'science')]
    public function index(
        ManagerRegistry  $managerRegistry,
        PlanetRepository $p,
        $slug = NULL,
    ): Response {
        $pl     = new Planet();
        $userid = $this->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet                   = $this->getPlanets($managerRegistry, $slug);
        $planet["selectedPlanet"] = $planet["selectedPlanet"][0];
        $planet["darkmatter"] = $p->getDarkmatter($userid)[0]['darkmatter'];
        $science                  = $p->getPlanetScience($userid, $slug, $managerRegistry);

        return $this->render('science/index.html.twig', [
            'planets' => $planet,
            'user'    => $this->getUser(),
            'slug'    => $slug,
            'science' => $science ?? NULL,
        ]);
    }
}
