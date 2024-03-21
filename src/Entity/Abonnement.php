<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AbonnementRepository;
use App\Entity\User;

#[ORM\Entity(repositoryClass:AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idab = null;

    #[ORM\Column]
    private  ?float $montantab=null;

    #[ORM\Column]
    private ?\DateTime $dateexpirationab=null;

    #[ORM\Column(length:255)]
    private ?string $codepromoab=null;

    #[ORM\Column(length:255)]
    private ?string $typeab=null;

    #[ORM\Column]
    private ?int $dureeab=null;

    #[ORM\ManyToOne(inversedBy: "abonnements")]
    private ?User $idu=null;

    public function getIdab(): ?int
    {
        return $this->idab;
    }

    public function getMontantab(): ?float
    {
        return $this->montantab;
    }

    public function setMontantab(float $montantab): static
    {
        $this->montantab = $montantab;

        return $this;
    }

    public function getDateexpirationab(): ?\DateTimeInterface
    {
        return $this->dateexpirationab;
    }

    public function setDateexpirationab(\DateTimeInterface $dateexpirationab): static
    {
        $this->dateexpirationab = $dateexpirationab;

        return $this;
    }

    public function getCodepromoab(): ?string
    {
        return $this->codepromoab;
    }

    public function setCodepromoab(string $codepromoab): static
    {
        $this->codepromoab = $codepromoab;

        return $this;
    }

    public function getTypeab(): ?string
    {
        return $this->typeab;
    }

    public function setTypeab(string $typeab): static
    {
        $this->typeab = $typeab;

        return $this;
    }

    public function getDureeab(): ?int
    {
        return $this->dureeab;
    }

    public function setDureeab(int $dureeab): static
    {
        $this->dureeab = $dureeab;

        return $this;
    }

    public function getIdu(): ?User
    {
        return $this->idu;
    }

    public function setIdu(?User $idu): static
    {
        $this->idu = $idu;

        return $this;
    }



}
