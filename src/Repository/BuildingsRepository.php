<?php

namespace App\Repository;

use App\Entity\Buildings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Buildings>
 *
 * @method Buildings|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Buildings|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Buildings[]    findAll()
 * @method Buildings[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class BuildingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Buildings::class);
    }

    public function save(Buildings $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Buildings $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param array $buildingIds
     * @param int   $buildingId
     *
     * @return $buildable
     */
    public function getBuildingsWithDependants(string $uuid): array
    {

        $qb = $this->createQueryBuilder('b')
            ->andWhere('b.user_uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ;

        return $qb->getResult();


    }

//    /**
//     * @return Buildings[] Returns an array of Buildings objects
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

//    public function findOneBySomeField($value): ?Buildings
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
