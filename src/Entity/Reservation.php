<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use App\Entity\User;
use App\Entity\Seance;

#[ORM\Entity(repositoryClass:ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idreservation=null;

    #[ORM\Column(length:255)]
    private ?string $nompersonne=null;

    #[ORM\Column(length:255)]
    private ?string $prenompersonne=null;

    #[ORM\ManyToOne(inversedBy: "reservations")]
    private ?Seance $ids=null;

    #[ORM\ManyToOne(inversedBy: "reservations")]
    private ?User $iduser=null;

    public function getIdreservation(): ?int
    {
        return $this->idreservation;
    }

    public function getNompersonne(): ?string
    {
        return $this->nompersonne;
    }

    public function setNompersonne(string $nompersonne): static
    {
        $this->nompersonne = $nompersonne;

        return $this;
    }

    public function getPrenompersonne(): ?string
    {
        return $this->prenompersonne;
    }

    public function setPrenompersonne(string $prenompersonne): static
    {
        $this->prenompersonne = $prenompersonne;

        return $this;
    }

    public function getIds(): ?Seance
    {
        return $this->ids;
    }

   public function setIds(?Seance $ids): static
    {
        $this->ids = $ids;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }


}
