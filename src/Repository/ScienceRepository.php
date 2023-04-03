<?php

namespace App\Repository;

use App\Entity\Science;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Science>
 *
 * @method Science|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Science|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Science[]    findAll()
 * @method Science[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class ScienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Science::class);
    }

    public function save(Science $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Science $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findScienceByUserUuid($uuid, $mr)
    {

//        return $this->createQueryBuilder('s')
//                    ->select('s, user_science us')
//                    ->where('us.user_uuid = :val')
//                    ->andWhere('s.science_slug = us.science_slug')
//                    ->setParameter('val', $uuid)
//                    ->getQuery()
//                    ->getResult();
        return null;
    }

    //    /**
    //     * @return Science[] Returns an array of Science objects
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

    //    public function findOneBySomeField($value): ?Science
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
