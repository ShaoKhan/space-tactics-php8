<?php

namespace App\Entity;

use App\Repository\BuddylistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuddylistRepository::class)]
class Buddylist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $src = null;

    #[ORM\Column]
    private ?int $target = null;

    #[ORM\Column]
    private ?bool $accepted = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $asked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrc(): ?int
    {
        return $this->src;
    }

    public function setSrc(int $src): self
    {
        $this->src = $src;

        return $this;
    }

    public function getTarget(): ?int
    {
        return $this->target;
    }

    public function setTarget(int $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function isAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getAsked(): ?\DateTimeInterface
    {
        return $this->asked;
    }

    public function setAsked(\DateTimeInterface $asked): self
    {
        $this->asked = $asked;

        return $this;
    }
}
