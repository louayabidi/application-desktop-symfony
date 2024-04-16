<?php

namespace App\Repository;

use App\Entity\Participation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Participation>
 *
 * @method Participation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participation[]    findAll()
 * @method Participation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participation::class);
    }

//    /**
//     * @return Participation[] Returns an array of Participation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Participation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function search($term)
{
    return $this->createQueryBuilder('p')
        ->where('p.nomP LIKE :term')
        ->orWhere('p.prenomP LIKE :term')
        ->orWhere('p.email LIKE :term')
        ->orWhere('p.age LIKE :term')
        ->setParameter('term', '%'.$term.'%')
        ->getQuery()
        ->getResult();
}


   //////////trie//////////////
   public function getParticipantsCountByEvent(): array
   {
       $qb = $this->createQueryBuilder('p')
           ->select('COUNT(p.idP) as participantsCount, e.nomEve as eventName')
           ->leftJoin('p.idf_event', 'e')
           ->groupBy('e.nomEve');
   
       $results = $qb->getQuery()->getResult();
   
       return array_map(function ($row) {
           return (object) [
               'eventName' => $row['eventName'],
               'participantCount' => $row['participantsCount'],
           ];
       }, $results);
   }



}
