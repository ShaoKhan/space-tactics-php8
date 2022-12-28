<?php

namespace App\Repository;

use App\Entity\Planet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MongoDB\Driver\Manager;

/**
 * @extends ServiceEntityRepository<Planet>
 *
 * @method Planet|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Planet|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Planet[]    findAll()
 * @method Planet[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class PlanetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $planet)
    {
        parent::__construct($planet, Planet::class);
    }

    public function save(Planet $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Planet $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Planet[] Returns an array of Planet objects
     */
    public function findByField($value): array
    {
        return $this->createQueryBuilder('p')
                    ->andWhere('p.user_uuid = :val')
                    ->setParameter('val', $value)
                    ->orderBy('p.id', 'ASC')
            #->setMaxResults(10)
                    ->getQuery()
                    ->getResult();
    }

    public function findFirst($uuid): array
    {
        return $this->createQueryBuilder('p')
                    ->andWhere('p.user_uuid = :val')
                    ->setParameter('val', $uuid)
                    ->orderBy('p.id', 'ASC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @param string $userid
     * @param string $slug
     *
     * @return array Returns one Planet by Player and PlanetSlug
     */
    public function findByPlayerIdAndSlug(string $userid, string $slug): array
    {

        return $this->createQueryBuilder('p')
                   ->andWhere('p.user_uuid = :val')
                   ->andWhere('p.slug = :slug')
                   ->setParameter('val', $userid)
                   ->setParameter('slug', $slug)
                   ->getQuery()
                   ->getResult();
    }

    public function getPlanetBuildings($uuid, $slug, ManagerRegistry $mr)
    {

        $br = new BuildingsRepository($mr);
        $brqb = ($br->createQueryBuilder('b'));

        $qb = $this->createQueryBuilder('p')
                    ->andWhere('p.user_uuid = :val')
                    ->andWhere('p.slug = :slug')
                    ->setParameter('val', $uuid)
                    ->setParameter('slug', $slug)
                    ->getQuery()
                    ->getResult();

        return $qb;
    }


//    public function findOneBySomeField($value): ?Planet
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
