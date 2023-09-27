<?php

namespace App\Controller\Traits;


use App\Entity\Planet;
use App\Entity\PlanetType;
use App\Repository\PlanetTypeRepository;
use Symfony\Component\HttpFoundation\Request;

trait PlanetsTrait
{
    private function getPlanetsByPlayer(
        $managerRegistry,
        $user_uuid,
        $slug,
    ): array
    {
        $planetRepository = $managerRegistry->getRepository(Planet::class);
        $planets = $planetRepository->findByField($user_uuid);

        $selectedPlanet = null;
        $selectedPlanetTypeData = null;

        if($slug !== null) {
            foreach($planets as $planet) {
                if($planet->getSlug() === $slug) {
                    $selectedPlanet = $planet;
                    break;
                }
            }
        }

        if($selectedPlanet === null) {
            $selectedPlanet = reset($planets);
        }

        if($selectedPlanet !== null) {
            $planetTypeRepository = $managerRegistry->getRepository(PlanetType::class);
            $selectedPlanetTypeData = $planetTypeRepository->findByPlanetType($selectedPlanet->getType())[0];
        }

        return [$planets, $selectedPlanet, $selectedPlanetTypeData];
    }
}