<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EvenementRepository;

#[ORM\Entity(repositoryClass:EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idEve=null;

    #[ORM\Column(length:255)]
    private ?string $nomEve=null;

    #[ORM\Column]
    private ?\DateTime $dateDeve=null;

    #[ORM\Column]
    private ?\DateTime $dateFeve=null;

    #[ORM\Column]
    private ?int $nbrMax=null;

    #[ORM\Column(length:255)]
    private ?string  $adresseEve=null;

    #[ORM\Column(length:255)]
    private ?string $imageEve=null;

    public function getIdEve(): ?int
    {
        return $this->idEve;
    }

    public function getNomEve(): ?string
    {
        return $this->nomEve;
    }

    public function setNomEve(string $nomEve): static
    {
        $this->nomEve = $nomEve;

        return $this;
    }

    public function getDateDeve(): ?\DateTimeInterface
    {
        return $this->dateDeve;
    }

    public function setDateDeve(\DateTimeInterface $dateDeve): static
    {
        $this->dateDeve = $dateDeve;

        return $this;
    }

    public function getDateFeve(): ?\DateTimeInterface
    {
        return $this->dateFeve;
    }

    public function setDateFeve(\DateTimeInterface $dateFeve): static
    {
        $this->dateFeve = $dateFeve;

        return $this;
    }

    public function getNbrMax(): ?int
    {
        return $this->nbrMax;
    }

    public function setNbrMax(int $nbrMax): static
    {
        $this->nbrMax = $nbrMax;

        return $this;
    }

    public function getAdresseEve(): ?string
    {
        return $this->adresseEve;
    }

    public function setAdresseEve(string $adresseEve): static
    {
        $this->adresseEve = $adresseEve;

        return $this;
    }

    public function getImageEve(): ?string
    {
        return $this->imageEve;
    }

    public function setImageEve(string $imageEve): static
    {
        $this->imageEve = $imageEve;

        return $this;
    }


}
