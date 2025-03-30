<?php

namespace App\Entity;

use App\Repository\UserLibraryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserLibraryRepository::class)]
class UserLibrary extends BaseEntity
{
    #[ORM\Column]
    private ?\DateTimeImmutable $registrationAt = null;

    #[ORM\ManyToOne(inversedBy: 'library')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    private ?Library $library = null;

    public function getRegistrationAt(): ?\DateTimeImmutable
    {
        return $this->registrationAt;
    }

    public function setRegistrationAt(\DateTimeImmutable $registrationAt): static
    {
        $this->registrationAt = $registrationAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(?Library $library): static
    {
        $this->library = $library;

        return $this;
    }
}
