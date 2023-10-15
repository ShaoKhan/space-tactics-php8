<?php

namespace App\Repository;

use App\Entity\Planet;
use App\Entity\PlanetBuilding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanetBuilding>
 *
 * @method PlanetBuilding|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanetBuilding|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanetBuilding[]    findAll()
 * @method PlanetBuilding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetBuildingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanetBuilding::class);
    }

    public function save(PlanetBuilding $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlanetBuilding $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getPlanetBuildingsByPlanetId(EntityManagerInterface $entityManager, int $planetId)
    {
        $query = $entityManager->createQuery(
            '
    SELECT pb, b.name AS buildingName
    FROM App\Entity\PlanetBuilding pb
    JOIN pb.building_id b
    WHERE pb.planet_id = :planetId
',
        );

        $query->setParameter('planetId', $planetId);
        return $query->getResult();
    }

    //    /**
    //     * @return PlanetBuilding[] Returns an array of PlanetBuilding objects
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

    //    public function findOneBySomeField($value): ?PlanetBuilding
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
