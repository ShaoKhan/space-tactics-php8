<?php

namespace App\Entity;

use App\Repository\BuildingDependenciesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingDependenciesRepository::class)]
class BuildingDependencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $buildingId = null;

    #[ORM\Column]
    private ?int $dependentBuildingId = null;

    #[ORM\Column]
    private ?int $requiredLevel = null;

    #[ORM\Column]
    private ?int $dependent_science_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildingId(): ?int
    {
        return $this->buildingId;
    }

    public function setBuildingId(int $buildingId): self
    {
        $this->buildingId = $buildingId;

        return $this;
    }

    public function getDependentBuildingId(): ?int
    {
        return $this->dependentBuildingId;
    }

    public function setDependentBuildingId(int $dependentBuildingId): self
    {
        $this->dependentBuildingId = $dependentBuildingId;

        return $this;
    }

    public function getRequiredLevel(): ?int
    {
        return $this->requiredLevel;
    }

    public function setRequiredLevel(int $requiredLevel): self
    {
        $this->requiredLevel = $requiredLevel;

        return $this;
    }

    public function getDependentScienceId(): ?int
    {
        return $this->dependent_science_id;
    }

    public function setDependentScienceId(int $dependent_science_id): self
    {
        $this->dependent_science_id = $dependent_science_id;

        return $this;
    }
}
