<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EvenementRepository;
use App\Repository\ParticipationRepository;
use Doctrine\DBAL\Schema\UniqueConstraint;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass:EvenementRepository::class)]


#[ORM\Table(name: 'evenement', uniqueConstraints: [
    new UniqueConstraint(name: 'unique_evenement_nom_date', columns: ['nomEve', 'dateDeve'])
])]

class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idEve=null;

    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"Le nom de l'evenement est requis")]
    private ?string $nomEve=null;

    #[ORM\Column]
    #[Assert\GreaterThan("today", message: "La date de début ne peut pas être dans le passé.")]
    private ?\DateTime $dateDeve=null;

    #[ORM\Column]
    #[Assert\GreaterThan(propertyPath: "dateDeve", message: "La date de fin doit être postérieure à la date de début.")]
    private ?\DateTime $dateFeve=null;

    #[ORM\Column]
    private ?int $nbrMax=null;

    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"L'adresse' est requis")]
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

// Méthode toString pour la classe Evenement
public function __toString(): string
{
    return sprintf(
        "Événement : %s\nDate : %s à %s\nAdresse : %s",
        $this->getNomEve() ?? 'N/A',
        $this->getDateDeve()->format('d/m/Y') ?? 'N/A',
        $this->getDateFeve()->format('d/m/Y') ?? 'N/A',
        $this->getAdresseEve() ?? 'N/A'
    );
}

// Ajoutez cette méthode pour obtenir l'URL de l'événement
public function getUrl(UrlGeneratorInterface $urlGenerator): string
{
    // Remplacez 'app_evenement_show' par le nom de votre route pour afficher les détails de l'événement
    return $urlGenerator->generate('app_evenement_show', ['idEve' => $this->getIdEve()]);
}



public function getParticipations(ParticipationRepository $participationRepository): array
{ 
    // Vérifie si le nombre maximum de participants est atteint
    if ($this->getNbrMax() !== null && count($participationRepository->findBy(['idf_event' => $this->getIdEve()])) >= $this->getNbrMax()) {
        return [];
    }

    // Sinon, retourne les participations associées à cet événement
    return $participationRepository->findBy(['idfEvent' => $this->getIdEve()]);
}


    

}
