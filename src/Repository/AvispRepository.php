<?php

namespace App\Repository;

use App\Entity\Avisp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Avisp>
 *
 * @method Avisp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avisp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avisp[]    findAll()
 * @method Avisp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvispRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avisp::class);
    }

//    /**
//     * @return Avisp[] Returns an array of Avisp objects
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

//    public function findOneBySomeField($value): ?Avisp
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
