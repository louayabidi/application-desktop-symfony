<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AvisEquipementRepository;
use App\Entity\User;
use App\Entity\Equipement;

#[ORM\Entity(repositoryClass:AvisEquipementRepository::class)]
class Avisequipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idaeq =null;

    #[ORM\Column(length:255)]
    private ?string $commaeq=null;

    #[ORM\Column]
    private ?bool $like;

    #[ORM\Column]
    private ?bool $dislike;

    #[ORM\ManyToOne(inversedBy: "aviseEquipements")]
    private ?User $idus=null;

    #[ORM\ManyToOne(inversedBy: "aviseEquipements")]
    private ?Equipement $ideq=null;

    public function getIdaeq(): ?int
    {
        return $this->idaeq;
    }

    public function getCommaeq(): ?string
    {
        return $this->commaeq;
    }

    public function setCommaeq(string $commaeq): static
    {
        $this->commaeq = $commaeq;

        return $this;
    }

    public function isLike(): ?bool
    {
        return $this->like;
    }

    public function setLike(bool $like): static
    {
        $this->like = $like;

        return $this;
    }

    public function isDislike(): ?bool
    {
        return $this->dislike;
    }

    public function setDislike(bool $dislike): static
    {
        $this->dislike = $dislike;

        return $this;
    }

    public function getIdus(): ?User
    {
        return $this->idus;
    }

    public function setIdus(?User $idus): static
    {
        $this->idus = $idus;

        return $this;
    }

    public function getIdeq(): ?Equipement
    {
        return $this->ideq;
    }

    public function setIdeq(?Equipement $ideq): static
    {
        $this->ideq = $ideq;

        return $this;
    }


}
