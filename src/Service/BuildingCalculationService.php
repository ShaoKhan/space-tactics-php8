<?php

namespace App\Service;

use App\Entity\Buildings;
use App\Entity\PlanetBuilding;
use App\Repository\BuildingsRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class BuildingCalculationService
{

    public function calculateNextBuildingLevelProduction($buildingId, $planetId, ManagerRegistry $mr): int
    {
        //get the built level of the building
        $planetBuildingRepository = $mr->getRepository(PlanetBuilding::class);
        $buildingOnPlanet         = $planetBuildingRepository->findOneBy(['planet_id' => $planetId, 'building_id' => $buildingId]);

        //get the building data
        $buildingRepository = $mr->getRepository(Buildings::class);
        $buildingData       = $buildingRepository->findOneBy(['id' => $buildingId]);

        $buildingLevel = $buildingOnPlanet?->getBuildingLevel() ?? 1;

        return match ($buildingId) {
            1       => (30 * ($buildingLevel + 1) * pow((1.1), ($buildingLevel + 1))) * (0.1 * $buildingData->getFactor()),
            2, 4    => (20 * ($buildingLevel + 1) * pow((1.1), ($buildingLevel + 1))) * (0.1 * $buildingData->getFactor()),
            3       => (10 * ($buildingLevel + 1) * pow((1.1), ($buildingLevel + 1))) * (0.1 * $buildingData->getFactor()),
            default => 0,
        };
    }

    public function calculateNextBuildingLevelEnergyCosts($buildingId, $planetId, ManagerRegistry $mr): int
    {
        //get the built level of the building
        $planetBuildingRepository = $mr->getRepository(PlanetBuilding::class);
        $buildingOnPlanet         = $planetBuildingRepository->findOneBy(['planet_id' => $planetId, 'building_id' => $buildingId]);

        //get the building data
        $buildingRepository = $mr->getRepository(Buildings::class);
        $buildingData       = $buildingRepository->findOneBy(['id' => $buildingId]);

        return match ($buildingId) {
            1, 2    => -(10 * ($buildingOnPlanet->getBuildingLevel() + 1) * pow((1.1), $buildingOnPlanet->getBuildingLevel())) * (0.1 * $buildingData->getFactor()),
            3       => -(30 * $buildingOnPlanet->getBuildingLevel() * pow((1.1), $buildingOnPlanet->getBuildingLevel())) * (0.1 * $buildingData->getFactor()),
            default => 0,
        };
    }

    public function calculateNextBuildingCosts($buildingId, $planetId, ManagerRegistry $mr): array
    {
        //get the built level of the building
        $planetBuildingRepository = $mr->getRepository(PlanetBuilding::class);
        $buildingOnPlanet         = $planetBuildingRepository->findOneBy(['planet_id' => $planetId, 'building_id' => $buildingId]);

        //get the building data
        $buildingRepository = $mr->getRepository(Buildings::class);
        $buildingData       = $buildingRepository->findOneBy(['id' => $buildingId]);

        $buildingLevel = $buildingOnPlanet?->getBuildingLevel() ?? 1;

        $buildCosts["metal"]       = ceil($buildingData->getCostMetal() * pow($buildingData->getFactor(), $buildingLevel + 1));
        $buildCosts["crystal"]     = ceil($buildingData->getCostCrystal() * pow($buildingData->getFactor(), $buildingLevel + 1));
        $buildCosts["deuterium"]   = ceil($buildingData->getCostDeuterium() * pow($buildingData->getFactor(), $buildingLevel + 1));
        $buildCosts["dark_matter"] = ceil($buildingData->getCostDarkMatter() * pow($buildingData->getFactor(), $buildingLevel + 1));
        return $buildCosts;

    }

    public function calculateActualBuildingProduction($metalLevel, $crystalLevel, $deuteriumLevel, $managerRegistry): array
    {
        $buildingData = new BuildingsRepository($managerRegistry);
        $metal        = $buildingData->findBy(['id' => 1]);
        $crystal      = $buildingData->findBy(['id' => 2]);
        $deuterium    = $buildingData->findBy(['id' => 3]);

        $metalPerHour     = (30 * $metalLevel * pow((1.1), $metalLevel)) * (0.1 * $metal[0]->getFactor());
        $crystalPerHour   = (20 * $crystalLevel * pow((1.1), $crystalLevel)) * (0.1 * $crystal[0]->getFactor());
        $deuteriumPerHour = (10 * $deuteriumLevel * pow((1.1), $deuteriumLevel)) * (0.1 * $deuterium[0]->getFactor());
        return [$metalPerHour, $crystalPerHour, $deuteriumPerHour];
    }


}