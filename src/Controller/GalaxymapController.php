<?php

namespace App\Controller;

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
        Request          $request,
        ManagerRegistry  $managerRegistry,
        PlanetRepository $p,
        UniRepository    $ur,
        $slug = NULL,

    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $userid                   = $this->getUser()->getUuid();
        $planet                   = $this->getPlanets($managerRegistry, $slug);
        $planet["selectedPlanet"] = $planet["selectedPlanet"][0];
        $planet["darkmatter"]     = $p->getDarkmatter($userid)[0]['darkmatter'];
        $uniDimensions            = $ur->getUniDimensions()[0];

        if($request->get('slug') !== NULL) {
            $slug = $request->get('slug');
        }

        if($uniDimensions["galaxy_width"] <= 50 && $uniDimensions["galaxy_height"] <= 50) {
            $uniDimensions['itemsize']  = 27;
            $uniDimensions['break'] = 50;

        } elseif($uniDimensions["galaxy_width"] <= 100 && $uniDimensions["galaxy_height"] <= 100) {
            $uniDimensions['itemsize'] = 13;
            $uniDimensions['break'] = 100;
        }elseif($uniDimensions["galaxy_width"] <= 200 && $uniDimensions["galaxy_height"] <= 200) {
            $uniDimensions['itemsize']  = 6.7;
            $uniDimensions['break'] = 200;
        }else{
            $uniDimensions['itemsize'] = 0;
            $uniDimensions['break'] = 0;
        }

        $coords = $p->getAllCoords();

        return $this->render('galaxymap/index.html.twig', [
            'planets'    => $planet,
            'user'       => $this->getUser(),
            'slug'       => $slug,
            'dimensions' => $uniDimensions,
            'coords' => $coords,
        ]);
    }
}
