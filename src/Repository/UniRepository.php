<?php

namespace App\Repository;

use App\Entity\Uni;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Uni>
 *
 * @method Uni|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uni|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uni[]    findAll()
 * @method Uni[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uni::class);
    }

    public function save(Uni $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Uni $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getUniDimensions()
    {
        return $this->createQueryBuilder('u')
            ->select('u.galaxy_width', 'u.galaxy_height', 'u.galaxy_depth')
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Uni[] Returns an array of Uni objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Uni
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
