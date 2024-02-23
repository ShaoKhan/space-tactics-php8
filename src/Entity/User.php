<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
##[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = NULL;

    #[ORM\Column(length: 255)]
    private ?string $uuid = NULL;

    #[ORM\Column(length: 75)]
    private ?string $username = NULL;

    #[ORM\Column(length: 125)]
    private ?string $email = NULL;

    #[ORM\Column(length: 255)]
    private ?string $password = NULL;

    #[ORM\Column(length: 5)]
    private ?string $locale = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $uni = NULL;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $register_on = NULL;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: TRUE)]
    private ?\DateTimeInterface $activate_on = NULL;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: TRUE)]
    private ?\DateTimeInterface $referal_on = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $referal_by = NULL;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: TRUE)]
    private ?\DateTimeInterface $last_active = NULL;

    #[ORM\Column(length: 255, nullable: true)]
    private ?array $roles = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isVerified = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $login_on = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $logout_on = null;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getUni(): ?int
    {
        return $this->uni;
    }

    public function setUni(int $uni): self
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

    public function setReferalBy(?int $referal_by): self
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

    public function getIsVerified(): ?int
    {
        return $this->is_verified;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(?int $is_verified): self
    {
        $this->is_verified = $is_verified;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->username,
                $this->password,
                // see section on salt below
                // $this->salt,
            ],
        );
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        [
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ] = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getLoginOn(): ?\DateTimeInterface
    {
        return $this->login_on;
    }

    public function setLoginOn(?\DateTimeInterface $login_on): static
    {
        $this->login_on = $login_on;

        return $this;
    }

    public function getLogoutOn(): ?\DateTimeInterface
    {
        return $this->logout_on;
    }

    public function setLogoutOn(?\DateTimeInterface $logout_on): static
    {
        $this->logout_on = $logout_on;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }
}
