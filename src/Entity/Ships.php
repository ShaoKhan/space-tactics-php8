<?php

namespace App\Entity;

use App\Repository\ShipsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShipsRepository::class)]
class Ships
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $class = null;

    #[ORM\Column]
    private ?int $one_per_planet = null;

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

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?int $consumption_deuterium = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column]
    private ?int $attack = null;

    #[ORM\Column]
    private ?int $defense = null;

    #[ORM\Column]
    private ?int $drive_science = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getClass(): ?int
    {
        return $this->class;
    }

    public function setClass(int $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getOnePerPlanet(): ?int
    {
        return $this->one_per_planet;
    }

    public function setOnePerPlanet(int $one_per_planet): static
    {
        $this->one_per_planet = $one_per_planet;

        return $this;
    }

    public function getLevelMax(): ?int
    {
        return $this->level_max;
    }

    public function setLevelMax(int $level_max): static
    {
        $this->level_max = $level_max;

        return $this;
    }

    public function getCostMetal(): ?int
    {
        return $this->cost_metal;
    }

    public function setCostMetal(int $cost_metal): static
    {
        $this->cost_metal = $cost_metal;

        return $this;
    }

    public function getCostCrystal(): ?int
    {
        return $this->cost_crystal;
    }

    public function setCostCrystal(int $cost_crystal): static
    {
        $this->cost_crystal = $cost_crystal;

        return $this;
    }

    public function getCostDeuterium(): ?int
    {
        return $this->cost_deuterium;
    }

    public function setCostDeuterium(int $cost_deuterium): static
    {
        $this->cost_deuterium = $cost_deuterium;

        return $this;
    }

    public function getCostDarkMatter(): ?int
    {
        return $this->cost_dark_matter;
    }

    public function setCostDarkMatter(int $cost_dark_matter): static
    {
        $this->cost_dark_matter = $cost_dark_matter;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getConsumptionDeuterium(): ?int
    {
        return $this->consumption_deuterium;
    }

    public function setConsumptionDeuterium(int $consumption_deuterium): static
    {
        $this->consumption_deuterium = $consumption_deuterium;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): static
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getDriveScience(): ?int
    {
        return $this->drive_science;
    }

    public function setDriveScience(int $drive_science): static
    {
        $this->drive_science = $drive_science;

        return $this;
    }
}
