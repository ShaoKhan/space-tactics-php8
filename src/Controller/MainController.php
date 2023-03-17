<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
                               $slug = NULL
    ): Response
    {
        $userUuid = $this->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getAllPlayerPlanets($em, $userUuid);

        if ($slug === null) {
            $slug = $planets[0]->getSlug();
        }
        $planets["selectedPlanet"] = $this->getSelectedPlayerPlanet($em, $userUuid, $slug);

        return $this->render('main/index.html.twig', [
            'planets' => $planets,
            'user' => $this->getUser(),
            'slug' => $slug,
        ]);
    }
}
