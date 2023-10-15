<?php

namespace App\Repository;

use App\Entity\PlanetScience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanetScience>
 *
 * @method PlanetScience|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanetScience|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanetScience[]    findAll()
 * @method PlanetScience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetScienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanetScience::class);
    }

//    /**
//     * @return PlanetScience[] Returns an array of PlanetScience objects
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

//    public function findOneBySomeField($value): ?PlanetScience
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
