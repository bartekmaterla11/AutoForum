<?php

namespace App\Repository;

use App\Entity\InchTires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InchTires|null find($id, $lockMode = null, $lockVersion = null)
 * @method InchTires|null findOneBy(array $criteria, array $orderBy = null)
 * @method InchTires[]    findAll()
 * @method InchTires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InchTiresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InchTires::class);
    }

    // /**
    //  * @return InchTires[] Returns an array of InchTires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InchTires
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
