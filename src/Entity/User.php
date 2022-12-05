<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = NULL;
    
    #[ORM\Column]
    private ?int $uuid = NULL;
    
    #[ORM\Column(length: 75)]
    private ?string $nickname = NULL;
    
    #[ORM\Column(length: 125)]
    private ?string $email = NULL;
    
    #[ORM\Column(length: 255)]
    private ?string $pass = NULL;
    
    #[ORM\Column(length: 5)]
    private ?string $locale = NULL;
    
    #[ORM\Column(length: 1)]
    private ?int $uni = NULL;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $register_on = NULL;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: TRUE)]
    private ?\DateTimeInterface $activate_on = NULL;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: TRUE)]
    private ?\DateTimeInterface $referal_on = NULL;
    
    #[ORM\Column(length: 6)]
    private ?int $referal_by = NULL;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: TRUE)]
    private ?\DateTimeInterface $last_active = NULL;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUuid(): ?int
    {
        return $this->uuid;
    }
    
    public function setUuid(int $uuid): self
    {
        $this->uuid = $uuid;
        
        return $this;
    }
    
    public function getNickname(): ?string
    {
        return $this->nickname;
    }
    
    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;
        
        return $this;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): self
    {
        $this->email = $email;
        
        return $this;
    }
    
    public function getPass(): ?string
    {
        return $this->pass;
    }
    
    public function setPass(string $pass): self
    {
        $this->pass = $pass;
        
        return $this;
    }
    
    public function getLocale(): ?string
    {
        return $this->locale;
    }
    
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        
        return $this;
    }
    
    public function getUni(): ?string
    {
        return $this->uni;
    }
    
    public function setUni(string $uni): self
    {
        $this->uni = $uni;
        
        return $this;
    }
    
    public function getRegisterOn(): ?\DateTimeInterface
    {
        return $this->register_on;
    }
    
    public function setRegisterOn(\DateTimeInterface $register_on): self
    {
        $this->register_on = $register_on;
        
        return $this;
    }
    
    public function getActivateOn(): ?\DateTimeInterface
    {
        return $this->activate_on;
    }
    
    public function setActivateOn(?\DateTimeInterface $activate_on): self
    {
        $this->activate_on = $activate_on;
        
        return $this;
    }
    
    public function getReferalOn(): ?\DateTimeInterface
    {
        return $this->referal_on;
    }
    
    public function setReferalOn(?\DateTimeInterface $referal_on): self
    {
        $this->referal_on = $referal_on;
        
        return $this;
    }
    
    public function getReferalBy(): ?int
    {
        return $this->referal_by;
    }
    
    public function setReferalBy(int $referal_by): self
    {
        $this->referal_by = $referal_by;
        
        return $this;
    }
    
    public function getLastActive(): ?\DateTimeInterface
    {
        return $this->last_active;
    }
    
    public function setLastActive(?\DateTimeInterface $last_active): self
    {
        $this->last_active = $last_active;
        
        return $this;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nickname', new NotBlank(['message' => 'Unter welchem Namen möchtest du dich anmelden?']));
        $metadata->addPropertyConstraint('nickname', new Assert\Length(['min' => 3]));
        $metadata->addPropertyConstraint('email', new Assert\Email(['message' => 'Die E-Mail "{{ value }}" ist nicht gültig.',]));
        $metadata->addPropertyConstraint('pass', new NotBlank(['message' => 'Ein Passwort wird benötigt!']));
        $metadata->addPropertyConstraint('pass', new Assert\Length(['min' => 8]));
        $metadata->addPropertyConstraint('pass', new Assert\NotCompromisedPassword(['message' => 'Das Passwort ist zu schwach!']));
        $metadata->addPropertyConstraint('locale', new NotBlank(['message' => 'In welcher Sprache dürfen wir dich begrüßen?']));
        $metadata->addPropertyConstraint('uni', new NotBlank(['message' => 'In welchem Universum möchtest du spielen?']));
    }
    
}
