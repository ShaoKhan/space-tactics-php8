<?php

namespace App\Entity;

use App\Repository\PlanetScienceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetScienceRepository::class)]
class PlanetScience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $planet_slug = null;

    #[ORM\Column(length: 255)]
    private ?string $science_slug = null;

    #[ORM\Column]
    private ?int $science_level = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getScienceSlug(): ?string
    {
        return $this->science_slug;
    }

    public function setScienceSlug(string $science_slug): static
    {
        $this->science_slug = $science_slug;

        return $this;
    }

    public function getScienceLevel(): ?int
    {
        return $this->science_level;
    }

    public function setScienceLevel(int $science_level): static
    {
        $this->science_level = $science_level;

        return $this;
    }
}
