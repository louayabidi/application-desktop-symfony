<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeanceRepository;

#[ORM\Entity(repositoryClass:SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
   // #[ORM\Column]
   #[ORM\Column(type: "integer")]
   
    private ?int $idseance=null;
    #[ORM\Column(length:255)]
    private ?string $nom=null;

    #[ORM\Column]
    private ?\DateTime $horaire=null;

    #[ORM\Column(length:255)]
    private ?string $jourseance=null;

    #[ORM\Column]
    private ?int  $numesalle=null;

    #[ORM\Column(length:255)]
    private ?string $duree=null;

    #[ORM\Column(length:255)]
    private ?string $imageseance;

    public function getIdseance(): ?int
    {
        return $this->idseance;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->horaire;
    }

    public function setHoraire(\DateTimeInterface $horaire): static
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getJourseance(): ?string
    {
        return $this->jourseance;
    }

    public function setJourseance(string $jourseance): static
    {
        $this->jourseance = $jourseance;

        return $this;
    }

    public function getNumesalle(): ?int
    {
        return $this->numesalle;
    }

    public function setNumesalle(int $numesalle): static
    {
        $this->numesalle = $numesalle;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getImageseance(): ?string
    {
        return $this->imageseance;
    }

    public function setImageseance(string $imageseance): static
    {
        $this->imageseance = $imageseance;

        return $this;
    }


}
