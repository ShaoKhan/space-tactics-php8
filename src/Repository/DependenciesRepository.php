<?php

namespace App\Repository;

use App\Entity\Dependencies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dependencies>
 *
 * @method Dependencies|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Dependencies|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Dependencies[]    findAll()
 * @method Dependencies[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class DependenciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dependencies::class);
    }

    public function save(Dependencies $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Dependencies $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getDependenciesById(int $id)
    {
        $rsm = new ResultSetMapping();
        $qb  = $this->getEntityManager()->createNativeQuery('SELECT * FROM dependencies d WHERE building_id = :val', $rsm);
        $qb->setParameter('val', $id);

        return $qb->getResult() ?? NULL;
    }

//    /**
//     * @return Dependencies[] Returns an array of Dependencies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dependencies
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
