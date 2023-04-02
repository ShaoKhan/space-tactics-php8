<?php

namespace App\Controller;

use App\Form\SupportType;
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
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);


        return $this->render('main/index.html.twig', [
            'planets' => $planets[0],
            'selectedPlanet' => $planets[1],
            'user' => $this->getUser(),
            'slug' => $slug,
        ]);
    }

    #[Route('/statistics/{slug?}', name: 'statistics')]
    public function statistics(
        Request                $request,
        ManagerRegistry        $managerRegistry,
        PlanetRepository       $p,
        EntityManagerInterface $em,
        Security $security,
                               $slug = NULL
    ):Response
    {
        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        return $this->render(
            'main/statistics.html.twig',
            [
                'planets' => $planets[0],
                'selectedPlanet' => $planets[1],
                'user' => $this->getUser(),
                'slug' => $slug,
            ]
        );
    }

    #[Route('/support/{slug?}', name: 'support')]
    public function support(
        Request                $request,
        ManagerRegistry        $managerRegistry,
        PlanetRepository       $p,
        EntityManagerInterface $em,
        Security $security,
                               $slug = NULL
    ):Response
    {
        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        $form = $this->createForm(SupportType::class);


        return $this->render(
            'main/support.html.twig',
            [
                'planets' => $planets[0],
                'selectedPlanet' => $planets[1],
                'user' => $this->getUser(),
                'slug' => $slug,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route('/rules/{slug?}', name: 'rules')]
    public function rules(
        Request                $request,
        ManagerRegistry        $managerRegistry,
        PlanetRepository       $p,
        EntityManagerInterface $em,
        Security $security,
                               $slug = NULL
    ):Response
    {
        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $user_uuid, $slug);

        return $this->render(
            'main/rules.html.twig',
            [
                'planets' => $planets[0],
                'selectedPlanet' => $planets[1],
                'user' => $this->getUser(),
                'slug' => $slug,
            ]
        );
    }

}
