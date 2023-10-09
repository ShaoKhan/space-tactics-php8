<?php

namespace App\Service;

use App\Entity\Buildings;
use App\Repository\BuildingsRepository;

class BuildingCalculationService
{

    public function calculateNextBuildingLevelProduction($building): int
    {
        return match ($building["id"]) {
            1       => (30 * ($building["building_level"] + 1) * pow((1.1), ($building["building_level"] + 1))) * (0.1 * $building["factor"]),
            2, 4    => (20 * ($building["building_level"] + 1) * pow((1.1), ($building["building_level"] + 1))) * (0.1 * $building["factor"]),
            3       => (10 * ($building["building_level"] + 1) * pow((1.1), ($building["building_level"] + 1))) * (0.1 * $building["factor"]),
            default => 0,
        };
    }

    public function calculateNextBuildingLevelEnergyCosts(array $building): int
    {
        return match ($building["id"]) {
            1, 2    => -(10 * ($building["building_level"] + 1) * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            3       => -(30 * $building["building_level"] * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            default => 0,
        };
    }

    public function calculateNextBuildingCosts(array $building): array
    {
        $buildCosts["metal"]       = ceil($building["cost_metal"] * pow($building["factor"], $building["building_level"] + 1));
        $buildCosts["crystal"]     = ceil($building["cost_crystal"] * pow($building["factor"], $building["building_level"] + 1));
        $buildCosts["deuterium"]   = ceil($building["cost_deuterium"] * pow($building["factor"], $building["building_level"] + 1));
        $buildCosts["dark_matter"] = ceil($building["cost_dark_matter"] * pow($building["factor"], $building["building_level"] + 1));
        return $buildCosts;

    }

    public function calculateActualBuildingProduction($metalLevel, $crystalLevel, $deuteriumLevel, $managerRegistry):array
    {
        $buildingData = new BuildingsRepository($managerRegistry);
        $metal = $buildingData->findBy(['id' => 1]);
        $crystal = $buildingData->findBy(['id' => 2]);
        $deuterium = $buildingData->findBy(['id' => 3]);

        $metalPerHour = (30 * $metalLevel * pow((1.1), $metalLevel)) * (0.1 * $metal[0]->getFactor());
        $crystalPerHour = (20 * $crystalLevel * pow((1.1), $crystalLevel)) * (0.1 * $crystal[0]->getFactor());
        $deuteriumPerHour = (10 * $deuteriumLevel * pow((1.1), $deuteriumLevel)) * (0.1 * $deuterium[0]->getFactor());
        return [$metalPerHour, $crystalPerHour, $deuteriumPerHour];
    }




}