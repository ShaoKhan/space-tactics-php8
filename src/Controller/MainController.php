<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\PlanetTypeRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/main/{planetID?}', name: 'main')]
    public function index(Request $request, ManagerRegistry $managerRegistry, ?PlanetRepository $planetRepo, $planetID = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $userRepo = new UserRepository($managerRegistry);
        $userdata = $userRepo->findBy(['email' => $this->getUser()->getUserIdentifier()]);
        if($planetRepo === NULL) {
            $planetRepo = new PlanetRepository($managerRegistry);
        }

        //ToDo needs Selected planet for display data and all others for dropdown
        $planets = $planetRepo->findBy(['user_uuid' => $userdata[0]->getUuid()]);

        if($planetID !== null) {
            $planetdata = $planetRepo->findBy(['user_uuid' => $userdata[0]->getUuid(), 'id' => $planetID,]);
        }else{
            $planetdata = $planetRepo->findBy(['user_uuid' => $userdata[0]->getUuid()]);
        }

        $planetTypeRepo = new PlanetTypeRepository($managerRegistry);
        foreach($planetdata as $planet){
            $planetTypeData[] = $planetTypeRepo->findBy(['type' => $planet->getType()])[0];
        }

        return $this->render('main/index.html.twig', [
            'user'    => $userdata[0],
            'selectPlanets' => $planets,
            'selectedPlanet' => $planetID,
            'planets' => $planetdata,
            'planetData' => $planetTypeData,
        ]);
    }
}
