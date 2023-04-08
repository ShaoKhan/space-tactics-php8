<?php

namespace App\Controller;

use App\Service\CheckMessagesService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends AbstractController
{

    public function __construct(
        CheckMessagesService $checkMessagesService,
        Security             $security,
        ManagerRegistry      $managerRegistry,
    )
    {
        parent::__construct($checkMessagesService, $security, $managerRegistry);
    }

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
            $planetRepo,
            $uniRepo,
    ): array {

        $min_x = $min_y = $min_z = 1;
        $max   = $uniRepo->findAll();
        $new_x = rand($min_x, $max[0]->getGalaxyWidth());
        $new_y = rand($min_y, $max[0]->getGalaxyHeight());
        $new_z = rand($min_z, $max[0]->getGalaxyDepth());

        $isTaken = $uniRepo->findOneBy([
            'galaxy_width' => (string)$new_x,
            'galaxy_height' => (string)$new_y,
            'galaxy_depth' => (string)$new_z,
        ]);

        if($isTaken === NULL) {
            return [
                'name' => $this->randomName(),
                'system_x' => $new_x,
                'system_y' => $new_y,
                'system_z' => $new_z,
                'type' => 1,
            ];
        } else {
            return [];
        }
    }


    private function randomName():string {
        $first = array(
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
        );

        $second = array(
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
        );

        $name = $first[rand ( 0 , count($first) -1)];
        $name .= ' ';
        $name .= $second[rand ( 0 , count($second) -1)];

        return $name;
    }
}
