<?php

namespace App\Repository;

use App\Entity\Handlebar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Handlebar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Handlebar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Handlebar[]    findAll()
 * @method Handlebar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandlebarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Handlebar::class);
    }

    // /**
    //  * @return Handlebar[] Returns an array of Handlebar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Handlebar
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
