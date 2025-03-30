<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    /**
     * @var Collection<int, UserLibrary>
     */
    #[ORM\OneToMany(targetEntity: UserLibrary::class, mappedBy: 'library')]
    private Collection $user;

    /**
     * @var Collection<int, Borrowing>
     */
    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'library')]
    private Collection $borrowings;

    /**
     * @var Collection<int, LibraryBook>
     */
    #[ORM\OneToMany(targetEntity: LibraryBook::class, mappedBy: 'library')]
    private Collection $libraryBooks;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'library')]
    private Collection $reservations;

    public function __construct()
    {
        parent::__construct();
        $this->user = new ArrayCollection();
        $this->borrowings = new ArrayCollection();
        $this->libraryBooks = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, UserLibrary>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(UserLibrary $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setLibrary($this);
        }

        return $this;
    }

    public function removeUser(UserLibrary $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLibrary() === $this) {
                $user->setLibrary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Borrowing>
     */
    public function getBorrowings(): Collection
    {
        return $this->borrowings;
    }

    public function addBorrowing(Borrowing $borrowing): static
    {
        if (!$this->borrowings->contains($borrowing)) {
            $this->borrowings->add($borrowing);
            $borrowing->setLibrary($this);
        }

        return $this;
    }

    public function removeBorrowing(Borrowing $borrowing): static
    {
        if ($this->borrowings->removeElement($borrowing)) {
            // set the owning side to null (unless already changed)
            if ($borrowing->getLibrary() === $this) {
                $borrowing->setLibrary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LibraryBook>
     */
    public function getLibraryBooks(): Collection
    {
        return $this->libraryBooks;
    }

    public function addLibraryBook(LibraryBook $libraryBook): static
    {
        if (!$this->libraryBooks->contains($libraryBook)) {
            $this->libraryBooks->add($libraryBook);
            $libraryBook->setLibrary($this);
        }

        return $this;
    }

    public function removeLibraryBook(LibraryBook $libraryBook): static
    {
        if ($this->libraryBooks->removeElement($libraryBook)) {
            // set the owning side to null (unless already changed)
            if ($libraryBook->getLibrary() === $this) {
                $libraryBook->setLibrary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setLibrary($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getLibrary() === $this) {
                $reservation->setLibrary(null);
            }
        }

        return $this;
    }
}
