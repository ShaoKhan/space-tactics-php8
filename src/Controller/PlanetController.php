<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Service\BuildingCalculationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends CustomAbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    private static function generatePlanetName(): string
    {
        return "";
    }

    #[Route('/planet', name: 'planet')]
    public function index(
        ManagerRegistry            $managerRegistry,
        PlanetRepository           $p,
        BuildingCalculationService $bcs,
        Security                   $security,
        Request                    $request,
                                   $slug = null,
    ): Response
    {

        $user_uuid = $security->getUser()->getUuid();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $planets = $this->getPlanetsByPlayer($managerRegistry, $this->user_uuid, $slug);
        $res = $p->findOneBy(['user_uuid' => $this->user_uuid, 'slug' => $slug]);
        $prodActual = $bcs->calculateActualBuildingProduction($res->getMetalBuilding(), $res->getCrystalBuilding(), $res->getDeuteriumBuilding(), $managerRegistry);

        return $this->render(
            'planet/index.html.twig', [
            'planets'        => $planets[0],
            'selectedPlanet' => $planets[1],
            'planetData'     => $planets[2],
            'user'           => $this->getUser(),
            'messages'       => $this->getMessages($security, $managerRegistry),
            'slug'           => $slug,
            'production'     => $prodActual,
        ],
        );
    }

    public function initialPlanetData(
        $planetRepo,
        $uniRepo,
    ): array
    {

        $min_x = $min_y = $min_z = 1;
        $max = $uniRepo->findAll();
        $new_x = rand($min_x, $max[0]->getGalaxyWidth());
        $new_y = rand($min_y, $max[0]->getGalaxyHeight());
        $new_z = rand($min_z, $max[0]->getGalaxyDepth());

        $isTaken = $uniRepo->findOneBy(
            [
                'galaxy_width'  => (string)$new_x,
                'galaxy_height' => (string)$new_y,
                'galaxy_depth'  => (string)$new_z,
            ],
        );

        if($isTaken === NULL) {
            return [
                'name'     => $this->randomName(),
                'system_x' => $new_x,
                'system_y' => $new_y,
                'system_z' => $new_z,
                'type'     => 1,
            ];
        }
        else {
            return [];
        }
    }


    private function randomName(): string
    {
        $first = [
            'Johnny',
            'Liu',
            'Stryker',
            'Fujin',
            'Shang',
            'Sareena',
            'Shao',
            'Sektor',
            'Jarek',
            'Rain',
            'Meat',
            'Shinnok',
            'Lyndia',
            'Sonya',
            'Sindel',
            'Kai',
            'Drahim',
            'Marquis',
            'Sheeva',
            'Sub',
            'Noob',
            'Zonia',
            'BoRai',
            'Moloch',
            'Blaze',
            'Nightwolf',
            'Reiko',
            'Tanya',
            'Goro',
            'Kung',
            'Tremor',
            'Khameleon',
            'Motaro',
            'Clora',
            'Mavado',
            'Cyrax',
            'Quan',
            'Ermac',
            'Kano',
            'Mileena',
            'Kitana',
            'Raiden',
            'Reptile',
            'Smoke',
            'Jax',
            'Kintaro',
            'Kenshi',
            'Hsu',
            'Jade',
            'Chameleon',
            'Baraka',
        ];

        $second = [
            'Mischke',
            'Serna',
            'Pingree',
            'Mcnaught',
            'Pepper',
            'Schildgen',
            'Mongold',
            'Wrona',
            'Geddes',
            'Lanz',
            'Fetzer',
            'Schroeder',
            'Block',
            'Mayoral',
            'Fleishman',
            'Roberie',
            'Latson',
            'Lupo',
            'Motsinger',
            'Drews',
            'Coby',
            'Redner',
            'Khan',
            'Culton',
            'Howe',
            'Stoval',
            'Michaud',
            'Mote',
            'Menjivar',
            'Wiers',
            'Paris',
            'Grisby',
            'Noren',
            'Damron',
            'Kazmierczak',
            'Haslett',
            'Guillemette',
            'Buresh',
            'Center',
            'Kucera',
            'Catt',
            'Badon',
            'Grumbles',
            'Antes',
            'Byron',
            'Volkman',
            'Klemp',
            'Pekar',
            'Pecora',
            'Schewe',
            'Ramage',
        ];

        $name = $first[rand(0, count($first) - 1)];
        $name .= ' ';
        $name .= $second[rand(0, count($second) - 1)];

        return $name;
    }
}
