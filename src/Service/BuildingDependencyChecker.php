<?php

namespace App\Service;

use App\Entity\BuildingDependency;
use App\Entity\Buildings;
use App\Entity\Planet;
use App\Entity\PlanetBuilding;
use App\Entity\Sciences;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class BuildingDependencyChecker
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function canConstructBuilding(int $buildingId, User $user, int $planetId): bool
    {
        $repository   = $this->entityManager->getRepository(BuildingDependency::class);
        $dependencies = $repository->findBy(['building' => $buildingId]);

        foreach($dependencies as $dependency) {

            $requiredBuildingId    = $dependency->getRequiredBuilding()->getId();
            $requiredBuildingLevel = $dependency->getRequiredBuildingLevel();
            $requiredScienceId     = $dependency->getRequiredScience();
            $requiredScienceLevel  = $dependency->getRequiredScienceLevel();
            $buildingDependencyMet = false;
            $scienceDependencyMet  = false;

            if($requiredBuildingId) {
                $requiredBuilding      = $this->findUserBuildingByPlanetIdAndBuildingId($requiredBuildingId, $planetId);
                $buildingDependencyMet = $requiredBuilding && $requiredBuilding->getBuildingLevel() >= $requiredBuildingLevel;
            }

            if($requiredScienceId) {
                $requiredScienceLevelByUser = $this->findUserScienceLevelById($requiredScienceId);
                $scienceDependencyMet = $requiredScienceLevel >= $requiredScienceLevelByUser;
            }

            if($buildingDependencyMet || $scienceDependencyMet) {
                return true; // At least one dependency is met
            }
        }
        return false; // None of the dependencies are met
    }

    private function findUserBuildingByPlanetIdAndBuildingId(
        int $buildingId,
        int $planetId,
    )
    {
        $mr = $this->entityManager->getRepository(PlanetBuilding::class);
        return $mr->findOneBy(['building_id' => $buildingId, 'planet_id' => $planetId]);
    }

    private function findUserScienceLevelById(int $scienceId): int|null
    {
        if($scienceId === 1) {
            $mr = $this->entityManager->getRepository(Sciences::class);
            return $mr->findOneBy(['science' => $scienceId]);
        }

        return null;
    }
}
