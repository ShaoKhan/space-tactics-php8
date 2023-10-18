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

    #[ORM\ManyToOne(targetEntity: Planet::class)]
    #[ORM\JoinColumn(name: 'planet_id', referencedColumnName: 'id', nullable: FALSE)]
    private ?Planet $planet_id;

    #[ORM\ManyToOne(targetEntity: Buildings::class)]
    #[ORM\JoinColumn(name: 'building_id', referencedColumnName: 'id', nullable: FALSE)]
    private ?Buildings $building_id;

    #[ORM\Column]
    private ?int $building_level = null;

    #[ORM\Column(length: 255)]
    private ?string $planet_slug = null;

    #[ORM\Column(length: 255)]
    private ?string $building_slug = null;

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

    public function getPlanetSlug(): ?string
    {
        return $this->planet_slug;
    }

    public function setPlanetSlug(string $planet_slug): static
    {
        $this->planet_slug = $planet_slug;

        return $this;
    }

    public function getBuildingSlug(): ?string
    {
        return $this->building_slug;
    }

    public function setBuildingSlug(string $building_slug): static
    {
        $this->building_slug = $building_slug;

        return $this;
    }
}
