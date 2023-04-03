<?php

namespace App\Entity;

use App\Repository\PlanetBuildingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetBuildingRepository::class)]
class PlanetBuilding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: FALSE)]
    private ?Planet $planet_id;

    #[ORM\Column(nullable: FALSE)]
    private ?Buildings $building_id;

    #[ORM\Column]
    private ?int $building_level = null;

    public function __construct()
    {
        $this->building_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanetId(): ?Planet
    {
        return $this->planet_id;
    }

    public function setPlanetId(?Planet $planet_id): self
    {
        $this->planet_id = $planet_id;

        return $this;
    }

    /**
     * @return Collection<int, buildings>
     */
    public function getBuildingId(): Collection
    {
        return $this->building_id;
    }

    public function addBuildingId(buildings $buildingId): self
    {
        if (!$this->building_id->contains($buildingId)) {
            $this->building_id->add($buildingId);
            $buildingId->setPlanetBuilding($this);
        }

        return $this;
    }

    public function removeBuildingId(buildings $buildingId): self
    {
        if ($this->building_id->removeElement($buildingId)) {
            // set the owning side to null (unless already changed)
            if ($buildingId->getPlanetBuilding() === $this) {
                $buildingId->setPlanetBuilding(null);
            }
        }

        return $this;
    }

    public function getBuildingLevel(): ?int
    {
        return $this->building_level;
    }

    public function setBuildingLevel(int $building_level): self
    {
        $this->building_level = $building_level;

        return $this;
    }
}
