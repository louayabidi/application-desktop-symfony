<?php

namespace App\Repository;

use App\Entity\Avisequipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Avisequipement>
 *
 * @method Avisequipement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avisequipement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avisequipement[]    findAll()
 * @method Avisequipement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisEquipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avisequipement::class);
    }

//    /**
//     * @return Avisequipement[] Returns an array of Avisequipement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Avisequipement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
