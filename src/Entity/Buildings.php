<?php

namespace App\Entity;

use App\Repository\BuildingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingsRepository::class)]
class Buildings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $factor = null;

    #[ORM\Column]
    private ?int $levelMax = null;

    #[ORM\Column]
    private ?int $costMetal = null;

    #[ORM\Column]
    private ?int $costCrystal = null;

    #[ORM\Column]
    private ?int $costDeuterium = null;

    #[ORM\Column]
    private ?int $costDarkMatter = null;

    #[ORM\Column]
    private ?int $costEnergy = null;

    #[ORM\Column(nullable: true)]
    private ?float $storageMetal = null;

    #[ORM\Column(nullable: true)]
    private ?float $storageCrystal = null;

    #[ORM\Column(nullable: true)]
    private ?float $storageDeuterium = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    private float $production;

    #[ORM\Column]
    private ?int $building_class = null;

    #[ORM\Column]
    private ?bool $onePerPlanet = null;

    #[ORM\Column]
    private ?bool $isBuildable = null;

    /**
     * @return float|null
     */
    public function getProduction(): ?float
    {
        return $this->production;
    }

    /**
     * @param float|null $production
     */
    public function setProduction(?float $production): void
    {
        $this->production = $production;
    }

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

    public function getFactor(): ?float
    {
        return $this->factor;
    }

    public function setFactor(?float $factor): self
    {
        $this->factor = $factor;

        return $this;
    }

    public function getLevelMax(): ?int
    {
        return $this->levelMax;
    }

    public function setLevelMax(int $levelMax): self
    {
        $this->levelMax = $levelMax;

        return $this;
    }

    public function getCostMetal(): ?int
    {
        return $this->costMetal;
    }

    public function setCostMetal(int $costMetal): self
    {
        $this->costMetal = $costMetal;

        return $this;
    }

    public function getCostCrystal(): ?int
    {
        return $this->costCrystal;
    }

    public function setCostCrystal(int $costCrystal): self
    {
        $this->costCrystal = $costCrystal;

        return $this;
    }

    public function getCostDeuterium(): ?int
    {
        return $this->costDeuterium;
    }

    public function setCostDeuterium(int $costDeuterium): self
    {
        $this->costDeuterium = $costDeuterium;

        return $this;
    }

    public function getCostDarkMatter(): ?int
    {
        return $this->costDarkMatter;
    }

    public function setCostDarkMatter(int $costDarkMatter): self
    {
        $this->costDarkMatter = $costDarkMatter;

        return $this;
    }

    public function getCostEnergy(): ?int
    {
        return $this->costEnergy;
    }

    public function setCostEnergy(int $costEnergy): self
    {
        $this->costEnergy = $costEnergy;

        return $this;
    }

    public function getStorageMetal(): ?float
    {
        return $this->storageMetal;
    }

    public function setStorageMetal(?float $storageMetal): self
    {
        $this->storageMetal = $storageMetal;

        return $this;
    }

    public function getStorageCrystal(): ?float
    {
        return $this->storageCrystal;
    }

    public function setStorageCrystal(?float $storageCrystal): self
    {
        $this->storageCrystal = $storageCrystal;

        return $this;
    }

    public function getStorageDeuterium(): ?float
    {
        return $this->storageDeuterium;
    }

    public function setStorageDeuterium(?float $storageDeuterium): self
    {
        $this->storageDeuterium = $storageDeuterium;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBuildingClass(): ?int
    {
        return $this->building_class;
    }

    public function setBuildingClass(int $building_class): static
    {
        $this->building_class = $building_class;

        return $this;
    }

    public function isOnePerPlanet(): ?bool
    {
        return $this->onePerPlanet;
    }

    public function setOnePerPlanet(bool $onePerPlanet): static
    {
        $this->onePerPlanet = $onePerPlanet;

        return $this;
    }

    public function isIsBuildable(): ?bool
    {
        return $this->isBuildable;
    }

    public function setIsBuildable(bool $isBuildable): static
    {
        $this->isBuildable = $isBuildable;

        return $this;
    }
}
