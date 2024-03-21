<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AvispRepository;
use App\Entity\User;
use App\Entity\Plat;

#[ORM\Entity(repositoryClass:AvispRepository::class)]
class Avisp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idap=null;

    #[ORM\Column(length:255)]
    private ?string $commap=null;

    #[ORM\Column]
    private ?int $star;

    #[ORM\Column]
    private ?bool $fav;

    #[ORM\ManyToOne(inversedBy: "avisePlats")]
    private ?Plat $idplat=null;

    #[ORM\ManyToOne(inversedBy: "avisePlats")]
    private ?User $iduap=null;

    public function getIdap(): ?int
    {
        return $this->idap;
    }

    public function getCommap(): ?string
    {
        return $this->commap;
    }

    public function setCommap(string $commap): static
    {
        $this->commap = $commap;

        return $this;
    }

    public function getStar(): ?int
    {
        return $this->star;
    }

    public function setStar(int $star): static
    {
        $this->star = $star;

        return $this;
    }

    public function isFav(): ?bool
    {
        return $this->fav;
    }

    public function setFav(bool $fav): static
    {
        $this->fav = $fav;

        return $this;
    }

    public function getIdplat(): ?Plat
    {
        return $this->idplat;
    }

    public function setIdplat(?Plat $idplat): static
    {
        $this->idplat = $idplat;

        return $this;
    }

    public function getIduap(): ?User
    {
        return $this->iduap;
    }

    public function setIduap(?User $iduap): static
    {
        $this->iduap = $iduap;

        return $this;
    }


}
