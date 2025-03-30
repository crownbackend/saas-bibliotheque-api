<?php

namespace App\Entity;

use App\Repository\LibraryBookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibraryBookRepository::class)]
class LibraryBook extends BaseEntity
{
    #[ORM\Column]
    private ?int $availableStock = null;

    #[ORM\Column]
    private ?int $totalStock = null;

    #[ORM\ManyToOne(inversedBy: 'libraryBooks')]
    private ?Library $library = null;

    #[ORM\ManyToOne(inversedBy: 'libraryBooks')]
    private ?Book $book = null;

    public function getAvailableStock(): ?int
    {
        return $this->availableStock;
    }

    public function setAvailableStock(int $availableStock): static
    {
        $this->availableStock = $availableStock;

        return $this;
    }

    public function getTotalStock(): ?int
    {
        return $this->totalStock;
    }

    public function setTotalStock(int $totalStock): static
    {
        $this->totalStock = $totalStock;

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

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }
}
