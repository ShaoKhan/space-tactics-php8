<?php

namespace App\Entity;

use App\Repository\ScienceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScienceRepository::class)]
class Science
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $factor = null;

    #[ORM\Column]
    private ?int $level_max = null;

    #[ORM\Column]
    private ?int $cost_metal = null;

    #[ORM\Column]
    private ?int $cost_crystal = null;

    #[ORM\Column]
    private ?int $cost_deuterium = null;

    #[ORM\Column]
    private ?int $cost_dark_matter = null;

    #[ORM\Column]
    private ?int $cost_energy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFactor(): ?int
    {
        return $this->factor;
    }

    public function setFactor(int $factor): self
    {
        $this->factor = $factor;

        return $this;
    }

    public function getLevelMax(): ?int
    {
        return $this->level_max;
    }

    public function setLevelMax(int $level_max): self
    {
        $this->level_max = $level_max;

        return $this;
    }

    public function getCostMetal(): ?int
    {
        return $this->cost_metal;
    }

    public function setCostMetal(int $cost_metal): self
    {
        $this->cost_metal = $cost_metal;

        return $this;
    }

    public function getCostCrystal(): ?int
    {
        return $this->cost_crystal;
    }

    public function setCostCrystal(int $cost_crystal): self
    {
        $this->cost_crystal = $cost_crystal;

        return $this;
    }

    public function getCostDeuterium(): ?int
    {
        return $this->cost_deuterium;
    }

    public function setCostDeuterium(int $cost_deuterium): self
    {
        $this->cost_deuterium = $cost_deuterium;

        return $this;
    }

    public function getCostDarkMatter(): ?int
    {
        return $this->cost_dark_matter;
    }

    public function setCostDarkMatter(int $cost_dark_matter): self
    {
        $this->cost_dark_matter = $cost_dark_matter;

        return $this;
    }

    public function getCostEnergy(): ?int
    {
        return $this->cost_energy;
    }

    public function setCostEnergy(int $cost_energy): self
    {
        $this->cost_energy = $cost_energy;

        return $this;
    }
}