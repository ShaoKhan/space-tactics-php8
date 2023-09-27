<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\ScienceRepository;
use App\Service\CheckMessagesService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScienceController extends AbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/science/{slug?}', name: 'science')]
    public function index(
        ManagerRegistry   $managerRegistry,
        ScienceRepository $sr,
        Security          $security,
        Request $request,
                          $slug = NULL,
    ): Response
    {

        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);
        $science = $sr->findScienceByUserUuid($user_uuid, $managerRegistry);

        if($slug === NULL) {
            $selectedPlanet = $planets[1];
            $slug = $selectedPlanet["slug"];
        }


        return $this->render(
            'science/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'science'        => $science ?? NULL,
            'slug'           => $slug,
        ],
        );
    }
}
