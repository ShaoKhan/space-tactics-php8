<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main/{slug?}', name: 'main')]
    public function index(Request $request, ManagerRegistry $managerRegistry, $slug = NULL): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planet = $this->getPlanets($managerRegistry, $slug);
        $planet["selectedPlanet"] = $planet["selectedPlanet"][0];

        if($request->get('slug') !== NULL) {
            $slug = $request->get('slug');
        }
        return $this->render('main/index.html.twig', [
            'planets' => $planet,
            'user'    => $this->getUser(),
            'slug'    => $slug,
        ]);
    }
}
