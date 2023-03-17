<?php

namespace App\Entity;

use App\Repository\PlanetTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetTypeRepository::class)]
class PlanetType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $fields = null;

    #[ORM\Column]
    private ?int $fieldsMax = null;

    #[ORM\Column]
    private ?float $tempMin = null;

    #[ORM\Column]
    private ?float $tempMax = null;

    #[ORM\Column]
    private ?int $diameter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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

    public function getFields(): ?int
    {
        return $this->fields;
    }

    public function setFields(int $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function getFieldsMax(): ?int
    {
        return $this->fieldsMax;
    }

    public function setFieldsMax(int $fieldsMax): self
    {
        $this->fieldsMax = $fieldsMax;

        return $this;
    }

    public function getTempMin(): ?float
    {
        return $this->tempMin;
    }

    public function setTempMin(float $tempMin): self
    {
        $this->tempMin = $tempMin;

        return $this;
    }

    public function getTempMax(): ?float
    {
        return $this->tempMax;
    }

    public function setTempMax(float $tempMax): self
    {
        $this->tempMax = $tempMax;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }
}
