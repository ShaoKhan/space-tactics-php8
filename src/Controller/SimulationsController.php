<?php

namespace App\Controller;

use App\Service\CheckMessagesService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimulationsController extends AbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    public function __construct(
        CheckMessagesService $checkMessagesService,
        Security             $security,
        ManagerRegistry      $managerRegistry,
    )
    {
        parent::__construct($checkMessagesService, $security, $managerRegistry);
    }

    #[Route('/simulations/{slug?}', name: 'simulations')]
    public function index(
        Request         $request,
        ManagerRegistry $managerRegistry,
        Security        $security,
                        $slug = NULL,
    ): Response
    {

        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        return $this->render(
            'simulations/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'slug'           => $slug,
        ],
        );
    }
}
