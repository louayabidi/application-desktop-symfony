<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 *
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

//    /**
//     * @return Evenement[] Returns an array of Evenement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Evenement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function findFutureEvents(\DateTimeInterface $currentDate)
{
    return $this->createQueryBuilder('e')
        ->andWhere('e.dateFeve > :currentDate')
        ->setParameter('currentDate', $currentDate)
        ->getQuery()
        ->getResult()
    ;
}

public function findArchivedEvents()
    {
        $currentDate = new \DateTime();
        
        return $this->createQueryBuilder('e')
            ->andWhere('e.dateFeve < :currentDate')
            ->setParameter('currentDate', $currentDate)
            ->getQuery()
            ->getResult()
        ;
    }


    public function search($term)
{
    return $this->createQueryBuilder('e')
        ->where('e.nomEve LIKE :term')
        ->orWhere('e.nbrMax LIKE :term')
        ->orWhere('e.dateDeve LIKE :term')
        ->orWhere('e.dateFeve LIKE :term')
        ->orWhere('e.adresseEve LIKE :term')
        ->setParameter('term', '%'.$term.'%')
        ->getQuery()
        ->getResult();
}


public function sortByAllAttributes(string $attribute, string $order = 'asc')
    {
        // Vérifier si l'attribut est valide
        $validAttributes = ['nomEve', 'dateDeve', 'dateFeve', 'adresseEve', 'nbrMax']; // Liste des attributs valides
        if (!in_array($attribute, $validAttributes)) {
            throw new \InvalidArgumentException("L'attribut spécifié n'est pas valide.");
        }

        // Créer la requête pour trier les événements en fonction de l'attribut et de l'ordre spécifiés
        $queryBuilder = $this->createQueryBuilder('e')
            ->orderBy('e.' . $attribute, $order);

        return $queryBuilder->getQuery()->getResult();
    }


}
