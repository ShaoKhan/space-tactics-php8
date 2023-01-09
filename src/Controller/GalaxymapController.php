<?php

namespace App\Controller;

use App\Entity\Uni;
use App\Repository\PlanetRepository;
use App\Repository\UniRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalaxymapController extends AbstractController
{
    #[Route('/galaxymap/{slug?}', name: 'galaxymap')]
    public function index(
        Request $request,
        ManagerRegistry $managerRegistry,
        PlanetRepository $p,
        UniRepository $ur,
        $slug = NULL

    ): Response
    {
        $userid = $this->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet                   = $this->getPlanets($managerRegistry, $slug);
        $planet["selectedPlanet"] = $planet["selectedPlanet"][0];
        $planet["darkmatter"]     = $p->getDarkmatter($userid)[0]['darkmatter'];
        $uniDimensions = $ur->getUniDimensions()[0];

        if($request->get('slug') !== NULL) {
            $slug = $request->get('slug');
        }

        $coords = $p->getAllCoords();

        return $this->render('galaxymap/index.html.twig', [
            'planets' => $planet,
            'user'    => $this->getUser(),
            'slug'    => $slug,
            'dimensions' => $uniDimensions,
        ]);
    }
}
