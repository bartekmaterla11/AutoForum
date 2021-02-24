<?php

namespace App\Repository;

use App\Entity\TypeTires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeTires|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTires|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTires[]    findAll()
 * @method TypeTires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTiresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTires::class);
    }

    // /**
    //  * @return TypeTires[] Returns an array of TypeTires objects
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
    public function findOneBySomeField($value): ?TypeTires
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
