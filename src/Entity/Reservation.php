<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Réservation
 */
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $cd = null;

    #[ORM\ManyToOne(inversedBy: 'room')]
    private ?Spinneret $sector = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Room $rooms = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getCd(): ?User
    {
        return $this->cd;
    }

    public function setCd(?User $cd): self
    {
        $this->cd = $cd;

        return $this;
    }

    public function getSector(): ?Spinneret
    {
        return $this->sector;
    }

    public function setSector(?Spinneret $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getRooms(): ?Room
    {
        return $this->rooms;
    }

    public function setRooms(?Room $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }
}
