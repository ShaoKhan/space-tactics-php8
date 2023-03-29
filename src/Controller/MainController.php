<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/main/{slug?}', name: 'main')]
    public function index(
        Request                $request,
        ManagerRegistry        $managerRegistry,
        PlanetRepository       $p,
        EntityManagerInterface $em,
                               Security $security,
                               $slug = NULL
    ): Response
    {
        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getAllPlayerPlanets($managerRegistry, $user_uuid);

        $firstPlanet = array_search($slug, array_column($planets, 'slug'));
        $selectedPlanet = $planets[$firstPlanet];




        if ($slug === NULL) {
            $selectedPlanet = $planets[0];
            $slug = $selectedPlanet["slug"];
        }

        return $this->render('main/index.html.twig', [
            'planets' => $planets,
            'selectedPlanet' => $selectedPlanet,
            'user' => $this->getUser(),
            'slug' => $slug,
        ]);
    }
}
