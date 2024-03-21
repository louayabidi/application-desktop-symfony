<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EquipementRepository;

#[ORM\Entity(repositoryClass:EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $ideq=null;

    #[ORM\Column(length:255)]
    private ?string $nomeq=null;

    #[ORM\Column(length:255)]
    private ?string $desceq=null;

    #[ORM\Column(length:255)]
    private ?string $doceq=null;

    #[ORM\Column(length:255)]
    private ?string $imageeq=null;

    #[ORM\Column(length:255)]
    private ?string $categeq=null;

    #[ORM\Column]
    private ?int $noteeq=null;

    #[ORM\Column(length:255)]
    private ?string $marqueeq=null;

    #[ORM\Column(length:255)]
    private ?string $matriculeeq=null;

    #[ORM\Column]
    private ?\DateTime $datepremainte=null;

    #[ORM\Column]
    private ?\DateTime $datepromainte=null;

    public function getIdeq(): ?int
    {
        return $this->ideq;
    }

    public function getNomeq(): ?string
    {
        return $this->nomeq;
    }

    public function setNomeq(string $nomeq): static
    {
        $this->nomeq = $nomeq;

        return $this;
    }

    public function getDesceq(): ?string
    {
        return $this->desceq;
    }

    public function setDesceq(string $desceq): static
    {
        $this->desceq = $desceq;

        return $this;
    }

    public function getDoceq(): ?string
    {
        return $this->doceq;
    }

    public function setDoceq(string $doceq): static
    {
        $this->doceq = $doceq;

        return $this;
    }

    public function getImageeq(): ?string
    {
        return $this->imageeq;
    }

    public function setImageeq(string $imageeq): static
    {
        $this->imageeq = $imageeq;

        return $this;
    }

    public function getCategeq(): ?string
    {
        return $this->categeq;
    }

    public function setCategeq(string $categeq): static
    {
        $this->categeq = $categeq;

        return $this;
    }

    public function getNoteeq(): ?int
    {
        return $this->noteeq;
    }

    public function setNoteeq(int $noteeq): static
    {
        $this->noteeq = $noteeq;

        return $this;
    }

    public function getMarqueeq(): ?string
    {
        return $this->marqueeq;
    }

    public function setMarqueeq(string $marqueeq): static
    {
        $this->marqueeq = $marqueeq;

        return $this;
    }

    public function getMatriculeeq(): ?string
    {
        return $this->matriculeeq;
    }

    public function setMatriculeeq(string $matriculeeq): static
    {
        $this->matriculeeq = $matriculeeq;

        return $this;
    }

    public function getDatepremainte(): ?\DateTimeInterface
    {
        return $this->datepremainte;
    }

    public function setDatepremainte(\DateTimeInterface $datepremainte): static
    {
        $this->datepremainte = $datepremainte;

        return $this;
    }

    public function getDatepromainte(): ?\DateTimeInterface
    {
        return $this->datepromainte;
    }

    public function setDatepromainte(\DateTimeInterface $datepromainte): static
    {
        $this->datepromainte = $datepromainte;

        return $this;
    }


}
