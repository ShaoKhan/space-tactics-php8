<?php

namespace App\Service;

class BuildingCalculationService
{

    public function calculateNextBuildingLevelProduction(array $building): int
    {
        return match ($building["id"]) {
            1 => (30 * $building["building_level"] * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            2, 4 => (20 * $building["building_level"] * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            3 => (10 * $building["building_level"] * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            default => 0,
        };
    }

    public function calculateNextBuildingLevelEnergyCosts(array $building):int
    {
        return match ($building["id"]) {
            1, 2 => -(10 * ($building["building_level"] + 1) * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            3 => -(30 * $building["building_level"] * pow((1.1), $building["building_level"])) * (0.1 * $building["factor"]),
            default => 0,
        };
    }


}