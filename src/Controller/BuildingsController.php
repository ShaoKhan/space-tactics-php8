<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingsController extends AbstractController
{
    #[Route('/buildings/{slug?}', name: 'buildings')]
    public function index(
        ManagerRegistry  $managerRegistry,
                         $slug = NULL,
        PlanetRepository $pr,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $allPlanets = [];
        $planet     = $this->getPlanets($managerRegistry, $slug);
        $userUuid   = $this->getUser()->getUuid();
        $allPlanets = $pr->findFirst($userUuid);

        if($slug !== NULL) {
            $allPlanets = $pr->findByPlayerIdAndSlug($userUuid, $slug);
        }

        return $this->render('buildings/index.html.twig', [
            'user'           => $this->getUser(),
            'selectPlanets'  => $planet['selectPlanets'],
            'selectedPlanet' => $slug,
            'planets'        => $planet['planets'],
            'planetData'     => $planet['planetData'],
        ]);
    }
}
