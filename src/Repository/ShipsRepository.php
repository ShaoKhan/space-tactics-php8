<?php

namespace App\Repository;

use App\Entity\Ships;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ships>
 *
 * @method Ships|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ships|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ships[]    findAll()
 * @method Ships[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ships::class);
    }

//    /**
//     * @return Ships[] Returns an array of Ships objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ships
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
