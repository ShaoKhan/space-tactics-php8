<?php

namespace App\Repository;

use App\Entity\Sciences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sciences>
 *
 * @method Sciences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sciences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sciences[]    findAll()
 * @method Sciences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SciencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sciences::class);
    }

//    /**
//     * @return Sciences[] Returns an array of Sciences objects
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

//    public function findOneBySomeField($value): ?Sciences
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    public function findByPlanetAndPlayer($playerId, $planetId)
    {
        return $this->createQueryBuilder('s')
                    ->join('s.planetScience', 'ps')
                    ->join('ps.planet_slug', 'p')
                    ->andWhere('p.user_uuid = :playerId')
                    ->andWhere('p.id = :planetId')
                    ->setParameter('playerId', $playerId)
                    ->setParameter('planetId', $planetId)
                    ->getQuery()
                    ->getResult();

    }
}
