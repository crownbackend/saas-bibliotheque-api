<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $isbn = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $addedAt = null;

    /**
     * @var Collection<int, Borrowing>
     */
    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'Book')]
    private Collection $borrowings;

    /**
     * @var Collection<int, LibraryBook>
     */
    #[ORM\OneToMany(targetEntity: LibraryBook::class, mappedBy: 'book')]
    private Collection $libraryBooks;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'book')]
    private Collection $reservations;

    public function __construct()
    {
        parent::__construct();
        $this->borrowings = new ArrayCollection();
        $this->libraryBooks = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAddedAt(): ?\DateTimeImmutable
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeImmutable $addedAt): static
    {
        $this->addedAt = $addedAt;

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
            $borrowing->setBook($this);
        }

        return $this;
    }

    public function removeBorrowing(Borrowing $borrowing): static
    {
        if ($this->borrowings->removeElement($borrowing)) {
            // set the owning side to null (unless already changed)
            if ($borrowing->getBook() === $this) {
                $borrowing->setBook(null);
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
            $libraryBook->setBook($this);
        }

        return $this;
    }

    public function removeLibraryBook(LibraryBook $libraryBook): static
    {
        if ($this->libraryBooks->removeElement($libraryBook)) {
            // set the owning side to null (unless already changed)
            if ($libraryBook->getBook() === $this) {
                $libraryBook->setBook(null);
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
            $reservation->setBook($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getBook() === $this) {
                $reservation->setBook(null);
            }
        }

        return $this;
    }
}
