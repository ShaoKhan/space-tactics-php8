<?php

namespace App\Entity;

use App\Repository\MessageTypesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageTypesRepository::class)]
class MessageTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $message_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageType(): ?string
    {
        return $this->message_type;
    }

    public function setMessageType(string $message_type): self
    {
        $this->message_type = $message_type;

        return $this;
    }
}
