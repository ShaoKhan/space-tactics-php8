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

class DefenseController extends AbstractController
{
    #[Route('/defense/{slug?}', name: 'defense')]
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
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        return $this->render('defense/index.html.twig', [
            'planets' => $planets[0],
            'selectedPlanet' => $planets[1],
            'user' => $this->getUser(),
            'slug' => $slug,
        ]);
    }
}
