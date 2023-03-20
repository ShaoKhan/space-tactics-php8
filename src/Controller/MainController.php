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
        $planets = $p->getPlanetDataByPlayerUuid($userUuid);
        $selectedPlanet = array_search($slug, array_column($planets, 'slug'));


        if($slug === NULL) {
            [$planets["selectedPlanet"]] = $planets[0];
        }
        return $this->render('main/index.html.twig', [
            'planets' => $planets,
            'selectedPlanet' => $planets[$selectedPlanet],
            'user' => $this->getUser(),
            'slug' => $slug,
        ]);
    }
}
