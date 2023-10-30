<?php

namespace App\Repository;

use App\Entity\BuildingsQueue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BuildingsQueue>
 *
 * @method BuildingsQueue|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuildingsQueue|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuildingsQueue[]    findAll()
 * @method BuildingsQueue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildingsQueueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuildingsQueue::class);
    }

//    /**
//     * @return BuildingsQueue[] Returns an array of BuildingsQueue objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BuildingsQueue
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
