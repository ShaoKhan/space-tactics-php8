<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\SciencesRepository;
use App\Service\BuildingCalculationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScienceController extends CustomAbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/science/{slug?}', name: 'science')]
    public function index(
        ManagerRegistry            $managerRegistry,
        PlanetRepository           $p,
        BuildingCalculationService $bcs,
        SciencesRepository         $sr,
        Security                   $security,
        Request                    $request,
                                   $slug = NULL,
    ): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $this->user, $slug);

        if($slug === NULL) {
            $slug = $planets[1]->getSlug();
        }
        $res        = $p->findOneBy(['user_uuid' => $this->user->getUuid(), 'slug' => $slug]);
        $prodActual = $bcs->calculateActualBuildingProduction($res->getMetalBuilding(), $res->getCrystalBuilding(), $res->getDeuteriumBuilding(), $managerRegistry);

        //science
        #$sc = $sr->findByPlanetAndPlayer($this->user_uuid, $slug);
        $sc = $sr->findAll();


        return $this->render(
            'science/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'slug'           => $slug,
            'production'     => $prodActual,
            'science'             => $sc,
        ],
        );
    }
}
