<?php

namespace App\Repository;

use App\Entity\MarkOfVansAndTrucks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarkOfVansAndTrucks|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarkOfVansAndTrucks|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarkOfVansAndTrucks[]    findAll()
 * @method MarkOfVansAndTrucks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkOfVansAndTrucksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarkOfVansAndTrucks::class);
    }

    // /**
    //  * @return MarkOfVansAndTrucks[] Returns an array of MarkOfVansAndTrucks objects
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
    public function findOneBySomeField($value): ?MarkOfVansAndTrucks
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
