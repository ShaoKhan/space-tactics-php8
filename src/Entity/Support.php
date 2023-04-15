<?php

namespace App\Entity;

use App\Repository\SupportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupportRepository::class)]
class Support
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $uuid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datum = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $processed_by = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $processed_since = null;

    #[ORM\Column(nullable: true)]
    private ?bool $answered = null;

    #[ORM\Column(nullable: true)]
    private ?bool $closed = null;

    #[ORM\Column(nullable: true)]
    private ?int $parent_message = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getProcessedBy(): ?string
    {
        return $this->processed_by;
    }

    public function setProcessedBy(?string $processed_by): self
    {
        $this->processed_by = $processed_by;

        return $this;
    }

    public function getProcessedSince(): ?\DateTimeInterface
    {
        return $this->processed_since;
    }

    public function setProcessedSince(?\DateTimeInterface $processed_since): self
    {
        $this->processed_since = $processed_since;

        return $this;
    }

    public function isAnswered(): ?bool
    {
        return $this->answered;
    }

    public function setAnswered(?bool $answered): self
    {
        $this->answered = $answered;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(?bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    public function getParentMessage(): ?int
    {
        return $this->parent_message;
    }

    public function setParentMessage(?int $parent_message): self
    {
        $this->parent_message = $parent_message;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

}
