<?php

namespace App\Repository;

use App\Entity\PlanetType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanetType>
 *
 * @method PlanetType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanetType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanetType[]    findAll()
 * @method PlanetType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanetType::class);
    }

    public function save(PlanetType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlanetType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return PlanetType[] Returns an array of PlanetType objects
     */
    public function findByPlanetType($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.type = :val')
            ->setParameter('val', $value)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?PlanetType
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
