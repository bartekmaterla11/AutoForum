<?php

namespace App\Repository;

use App\Entity\MarkOfCars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarkOfCars|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarkOfCars|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarkOfCars[]    findAll()
 * @method MarkOfCars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkOfCarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarkOfCars::class);
    }

    // /**
    //  * @return MarkOfCars[] Returns an array of MarkOfCars objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarkOfCars
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
