<?php

namespace App\Entity;

use App\Repository\SpinneretRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Filère
 */
#[ORM\Entity(repositoryClass: SpinneretRepository::class)]
class Spinneret
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $course = null;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: Reservation::class)]
    private Collection $room;

    public function __construct()
    {
        $this->room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): self
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Reservation $room): self
    {
        if (!$this->room->contains($room)) {
            $this->room->add($room);
            $room->setSector($this);
        }

        return $this;
    }

    public function removeRoom(Reservation $room): self
    {
        if ($this->room->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getSector() === $this) {
                $room->setSector(null);
            }
        }

        return $this;
    }
}
