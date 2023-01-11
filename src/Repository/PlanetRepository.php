<?php

namespace App\Repository;

use App\Entity\Buildings;
use App\Entity\Planet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    /**
     * @param                 $uuid
     * @param                 $slug
     * @param ManagerRegistry $mr
     *
     * @return array Buildings
     */
    public function getPlanetBuildings($uuid, $slug, ManagerRegistry $mr):array
    {

        $br   = new BuildingsRepository($mr);
        $brqb = ($br->createQueryBuilder('b'));
        $qb   = $this->createQueryBuilder('p')
                     ->select(
                         '
            p.metal_building, 
            p.crystal_building,
            p.deuterium_building,
            p.solar_building,
            p.nuclear_building,
            p.robot_building,
            p.nanite_building,
            p.hangar_building,
            p.metalstorage_building,
            p.crystalstorage_building,
            p.deuteriumstorage_building,
            p.laboratory_building,
            p.university_building,
            p.alliancehangar_building,
            p.missilesilo_building
            ',
                     )
                     ->andWhere('p.user_uuid = :val')
                     ->andWhere('p.slug = :slug')
                     ->setParameter('val', $uuid)
                     ->setParameter('slug', $slug)
                     ->getQuery()
                     ->getResult();

        return $qb;
    }

    public function getPlanetNamesByUuid(string $uuid)
    {

        return $this->createQueryBuilder('p')
            #->select('p.name as name, p.slug as slug, p.system_x, p.system_y, p-system_z')
                    ->andWhere('p.user_uuid = :val')
                    ->setParameter('val', $uuid)
                    ->getQuery()
                    ->getResult();

    }

    public function getPlanetScience($uuid, $slug, ManagerRegistry $mr):array
    {

        $sr   = new ScienceRepository($mr);
        $sr->createQueryBuilder('b');
        $qb   = $this->createQueryBuilder('p')
                     ->select(
                         '
            p.metal_building, 
            p.crystal_building,
            p.deuterium_building,
            p.solar_building,
            p.nuclear_building,
            p.robot_building,
            p.nanite_building,
            p.hangar_building,
            p.metalstorage_building,
            p.crystalstorage_building,
            p.deuteriumstorage_building,
            p.laboratory_building,
            p.university_building,
            p.alliancehangar_building,
            p.missilesilo_building
            ',
                     )
                     ->andWhere('p.user_uuid = :val')
                     ->andWhere('p.slug = :slug')
                     ->setParameter('val', $uuid)
                     ->setParameter('slug', $slug)
                     ->getQuery()
                     ->getResult();

        return $qb;
    }

    public function getDarkmatter($uuid)
    {
        return $this->createQueryBuilder('p')
            ->select('p.darkmatter')
            ->where('p.user_uuid = :uuid')
            ->andWhere('p.darkmatter IS NOT null')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAllCoords()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p.system_x x, p.system_y y, p.system_z z')
            ->getQuery()
            ->getResult()
            ;
        foreach($query as $key => $value) {
            $coords[] = ['x' => $value['x'], 'y' => $value['y'], 'z' => $value['z']];
        }
        return $coords;
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
