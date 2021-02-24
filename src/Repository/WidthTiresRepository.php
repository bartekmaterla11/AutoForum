<?php

namespace App\Repository;

use App\Entity\WidthTires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WidthTires|null find($id, $lockMode = null, $lockVersion = null)
 * @method WidthTires|null findOneBy(array $criteria, array $orderBy = null)
 * @method WidthTires[]    findAll()
 * @method WidthTires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WidthTiresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WidthTires::class);
    }

    // /**
    //  * @return WidthTires[] Returns an array of WidthTires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WidthTires
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
