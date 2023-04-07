<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $from_uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $from_name = null;

    #[ORM\Column(length: 255)]
    private ?string $to_uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $to_name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $send_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column (type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private ?bool $was_read = null;

    #[ORM\Column (type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private ?bool $deleted = null;

    #[ORM\Column (type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private ?bool $answered = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column]
    private ?int $message_type = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromUuid(): ?string
    {
        return $this->from_uuid;
    }

    public function setFromUuid(string $from_uuid): self
    {
        $this->from_uuid = $from_uuid;

        return $this;
    }

    public function getFromName(): ?string
    {
        return $this->from_name;
    }

    public function setFromName(string $from_name): self
    {
        $this->from_name = $from_name;

        return $this;
    }

    public function getToUuid(): ?string
    {
        return $this->to_uuid;
    }

    public function setToUuid(string $to_uuid): self
    {
        $this->to_uuid = $to_uuid;

        return $this;
    }

    public function getToName(): ?string
    {
        return $this->to_name;
    }

    public function setToName(string $to_name): self
    {
        $this->to_name = $to_name;

        return $this;
    }

    public function getSendDate(): ?\DateTimeInterface
    {
        return $this->send_date;
    }

    public function setSendDate(\DateTimeInterface $send_date): self
    {
        $this->send_date = $send_date;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isWasRead(): ?bool
    {
        return $this->was_read;
    }

    public function setWasRead(bool $was_read): self
    {
        $this->was_read = $was_read;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function isAnswered(): ?bool
    {
        return $this->answered;
    }

    public function setAnswered(bool $answered): self
    {
        $this->answered = $answered;

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

    public function getMessageType(): ?int
    {
        return $this->message_type;
    }

    public function setMessageType(int $message_type): self
    {
        $this->message_type = $message_type;

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
