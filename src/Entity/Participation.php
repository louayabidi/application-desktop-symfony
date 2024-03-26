<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParticipationRepository;
use App\Entity\User;
use App\Entity\Evenement;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass:ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idP=null;

    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"Le nom est requis")]
    private ?string $nomP=null;

  #[ORM\Column(length:255)]
  #[Assert\NotBlank(message:"Le prénom est requis")]
private ?string $prenomP = null;

   #[ORM\Column(length:255)]
   #[Assert\NotBlank(message:"L'email est requis")]
    #[Assert\Email(message:"L'email '{{ value }}' n'est pas valide.")]
    private ?string $email=null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"L'âge est requis")]
    #[Assert\Type(type:"integer", message:"L'âge doit être un nombre entier.")]
    #[Assert\Range(min:13, max:80, minMessage:"L'âge doit être supérieur ou égal à 13.", maxMessage:"L'âge doit être inférieur ou égal à 80.")]
    private ?int $age=null;

  /*  #[ORM\ManyToOne(inversedBy: "participations")]
    private ?Evenement $idfEvent=null;

    #[ORM\ManyToOne(inversedBy: "participations")]
    private ?User $idUser=null;*/


    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: "participations")]
    #[ORM\JoinColumn(name: 'idf_event', referencedColumnName: 'id_eve')]
    private ?Evenement $idf_event=null;



    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_User', referencedColumnName: 'id')]    
    private ?User $id_User=null;


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
        return $this->idf_event;
    }

    public function setIdfEvent(?Evenement $idf_event): static
    {
        $this->idf_event = $idf_event;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_User;
    }

    public function setIdUser(?User $id_User): static
    {
        $this->id_User = $id_User;

        return $this;
    }


    public function __toString(): string
    {
        return sprintf(
            "Participant : %s %s\nEmail : %s\nÂge : %d",
            $this->getNomP() ?? 'N/A',
            $this->getPrenomP() ?? 'N/A',
            $this->getEmail() ?? 'N/A',
            $this->getAge() ?? 'N/A'
        );
    }


}
