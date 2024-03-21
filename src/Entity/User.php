<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass:UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id=null;

    #[ORM\Column(length:255)]
    private ?string $nom=null;

    #[ORM\Column(length:255)]
    private ?string  $prenom=null;

    #[ORM\Column(length:255)]
    private ?string $mail=null;

    #[ORM\Column(length:255)]
    private ?string $mdp=null;

    #[ORM\Column]
    private ?bool $statut = false;

    #[ORM\Column]
    private ?int $nbTentative=null;

    #[ORM\Column(length:255)]
    private ?string $image=null;

    #[ORM\Column]
    private ?\DateTime $dateNaissance = null;

    #[ORM\Column]
    private ?\DateTime $dateInscription=null;

    #[ORM\Column(length:255)]
    private ?string $tel=null;

    #[ORM\Column(length:255)]
    private ?string $role=null;

    #[ORM\Column]
    private ?float $poids=null;

    #[ORM\Column]
    private ?float $taille=null;

    #[ORM\Column(length:255)]
    private ?string $sexe=null;

    #[ORM\Column]
    private ?int $tfa=null;

    #[ORM\Column(length:255)]
    private ?string $tfaSecret=null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNbTentative(): ?int
    {
        return $this->nbTentative;
    }

    public function setNbTentative(int $nbTentative): static
    {
        $this->nbTentative = $nbTentative;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getTfa(): ?int
    {
        return $this->tfa;
    }

    public function setTfa(int $tfa): static
    {
        $this->tfa = $tfa;

        return $this;
    }

    public function getTfaSecret(): ?string
    {
        return $this->tfaSecret;
    }

    public function setTfaSecret(string $tfaSecret): static
    {
        $this->tfaSecret = $tfaSecret;

        return $this;
    }


}
