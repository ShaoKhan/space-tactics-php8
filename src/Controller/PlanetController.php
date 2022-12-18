<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends AbstractController
{

    private static function generatePlanetName(): string
    {
        return "";
    }

    #[Route('/planet', name: 'app_planet')]
    public function index(): Response
    {
        return $this->render('planet/index.html.twig', [
            'controller_name' => 'PlanetController',
        ]);
    }

    public function initialPlanetData(
        int $universe,
            $planetRepo,
            $uniRepo,
    ): array {

        $min_x = $min_y = $min_z = 1;
        $max   = $uniRepo->findAll();
        $new_x = rand($min_x, $max->get('galaxy_width'));
        $new_y = rand($min_y, $max->get('galaxy_height'));
        $new_z = rand($min_z, $max->get('galaxy_depth'));

        $isTaken = $uniRepo->findBy([
                                        'galaxy_width'  => $new_x,
                                        'galaxy_height' => $new_y,
                                        'galaxy_depth'  => $new_z,
                                    ]);

        if($isTaken === NULL) {
            return [
                'name',
                'universe' => $universe,
                'system_x' => $new_x,
                'system_y' => $new_y,
                'system_z' => $new_z,
                'type',
            ];
        } else {
            return [];
        }
    }
}
