<?php

namespace App\Controller;


use App\Repository\PlanetRepository;
use App\Service\BuildingCalculationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllianceController extends CustomAbstractController
{
    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/alliance/{slug?}', name: 'alliance')]
    public function index(
        ManagerRegistry $managerRegistry,
        PlanetRepository           $p,
        BuildingCalculationService $bcs,
        Security        $security,
                        $slug = NULL,
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $this->user_uuid, $slug);
        $res = $p->findOneBy(['user_uuid' => $this->user_uuid, 'slug' => $slug]);
        $prodActual = $bcs->calculateActualBuildingProduction($res->getMetalBuilding(), $res->getCrystalBuilding(), $res->getDeuteriumBuilding(), $managerRegistry);

        return $this->render(
            'alliance/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'slug'           => $slug,
            'production'     => $prodActual,
        ],
        );
    }
}
