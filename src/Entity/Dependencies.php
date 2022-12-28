<?php

namespace App\Entity;

use App\Repository\DependenciesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DependenciesRepository::class)]
class Dependencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $building_id = null;

    #[ORM\Column]
    private ?int $dependend_building_id = null;

    #[ORM\Column(length: 255)]
    private ?int $required_level = null;

    #[ORM\Column]
    private ?int $dependend_science_id = null;

    #[ORM\Column]
    private ?int $science_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildingId(): ?int
    {
        return $this->building_id;
    }

    public function setBuildingId(int $building_id): self
    {
        $this->building_id = $building_id;

        return $this;
    }

    public function getDependendBuildingId(): ?int
    {
        return $this->dependend_building_id;
    }

    public function setDependendBuildingId(int $dependend_building_id): self
    {
        $this->dependend_building_id = $dependend_building_id;

        return $this;
    }

    public function getRequiredLevel(): ?int
    {
        return $this->required_level;
    }

    public function setRequiredLevel(int $required_level): self
    {
        $this->required_level = $required_level;

        return $this;
    }

    public function getDependendScienceId(): ?int
    {
        return $this->dependend_science_id;
    }

    public function setDependendScienceId(int $dependend_science_id): self
    {
        $this->dependend_science_id = $dependend_science_id;

        return $this;
    }

    public function getScienceId(): ?int
    {
        return $this->science_id;
    }

    public function setScienceId(int $science_id): self
    {
        $this->science_id = $science_id;

        return $this;
    }
}
