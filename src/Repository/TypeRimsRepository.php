<?php

namespace App\Repository;

use App\Entity\TypeRims;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeRims|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRims|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRims[]    findAll()
 * @method TypeRims[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRimsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRims::class);
    }

    // /**
    //  * @return TypeRims[] Returns an array of TypeRims objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeRims
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
