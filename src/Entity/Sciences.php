<?php

namespace App\Entity;

use App\Repository\SciencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SciencesRepository::class)]
class Sciences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $science_class = null;

    #[ORM\Column]
    private ?int $one_per_planet = null;

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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct() {}

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

    public function getScienceClass(): ?int
    {
        return $this->science_class;
    }

    public function setScienceClass(int $science_class): static
    {
        $this->science_class = $science_class;

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

    public function getFactor(): ?int
    {
        return $this->factor;
    }

    public function setFactor(int $factor): static
    {
        $this->factor = $factor;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

}
