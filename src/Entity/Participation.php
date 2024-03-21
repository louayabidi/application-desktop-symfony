<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParticipationRepository;
use App\Entity\User;
use App\Entity\Evenement;

#[ORM\Entity(repositoryClass:ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idP=null;

    #[ORM\Column(length:255)]
    private ?string $nomP=null;

    #[ORM\Column(length:255)]
    private ?string $prenomP=null;

    #[ORM\Column(length:255)]
    private ?string $email=null;

    #[ORM\Column]
    private ?int $age=null;

    #[ORM\ManyToOne(inversedBy: "participations")]
    private ?Evenement $idfEvent=null;

    #[ORM\ManyToOne(inversedBy: "participations")]
    private ?User $idUser=null;

    public function getIdP(): ?int
    {
        return $this->idP;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(string $nomP): static
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getPrenomP(): ?string
    {
        return $this->prenomP;
    }

    public function setPrenomP(string $prenomP): static
    {
        $this->prenomP = $prenomP;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getIdfEvent(): ?Evenement
    {
        return $this->idfEvent;
    }

    public function setIdfEvent(?Evenement $idfEvent): static
    {
        $this->idfEvent = $idfEvent;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }


}
