<?php
/*
 * space-tactics-php8
 * BuildingsRepository.php | 1/27/23, 11:13 PM
 * Copyright (C)  2023 ShaoKhan
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Repository;

use App\Entity\Buildings;
use App\Entity\Planet;
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


    public function getBuildingPrice($buildingId)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.id = :buildingId')
            ->setParameter('buildingId', $buildingId)
            ->getQuery()
            ->getResult();
    }

    public function getPlanetBuildings($userUuid, $planetSlug)
    {
        $res = $this->createQueryBuilder('b')
            ->select(Planet::class, 'p')
            ->leftJoin('p.planet', 'p')

            ->andWhere('b.user_uuid = :userId')
            ->andWhere('b.slug = :planetSlug')
            ->setParameter('userId', $userUuid)
            ->setParameter('planetSlug', $planetSlug)
            ->getQuery()
            ->getResult();


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
