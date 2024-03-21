<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlatRepository;

#[ORM\Entity(repositoryClass:PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int  $idp=null;

    #[ORM\Column(length:255)]
    private ?string $nomp=null;

    #[ORM\Column]
    private ?float $prixp=null;

    #[ORM\Column(length:255)]
    private ?string $descp=null;

    #[ORM\Column(length:255)]
    private ?string $alergiep=null;

    #[ORM\Column]
    private ?bool $etatp;

    #[ORM\Column(length:255)]
    private ?string $photop = 'C:/Users/Yosr/Downloads/desktop-app/src/main/resources/imgs/pizza.PNG';

    #[ORM\Column]
    private ?int $calories;

    public function getIdp(): ?int
    {
        return $this->idp;
    }

    public function getNomp(): ?string
    {
        return $this->nomp;
    }

    public function setNomp(string $nomp): static
    {
        $this->nomp = $nomp;

        return $this;
    }

    public function getPrixp(): ?float
    {
        return $this->prixp;
    }

    public function setPrixp(float $prixp): static
    {
        $this->prixp = $prixp;

        return $this;
    }

    public function getDescp(): ?string
    {
        return $this->descp;
    }

    public function setDescp(string $descp): static
    {
        $this->descp = $descp;

        return $this;
    }

    public function getAlergiep(): ?string
    {
        return $this->alergiep;
    }

    public function setAlergiep(string $alergiep): static
    {
        $this->alergiep = $alergiep;

        return $this;
    }

    public function isEtatp(): ?bool
    {
        return $this->etatp;
    }

    public function setEtatp(bool $etatp): static
    {
        $this->etatp = $etatp;

        return $this;
    }

    public function getPhotop(): ?string
    {
        return $this->photop;
    }

    public function setPhotop(string $photop): static
    {
        $this->photop = $photop;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): static
    {
        $this->calories = $calories;

        return $this;
    }


}
