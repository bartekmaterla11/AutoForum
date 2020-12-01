<?php

namespace App\Repository;

use App\Entity\Ansewer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ansewer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ansewer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ansewer[]    findAll()
 * @method Ansewer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnsewerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ansewer::class);
    }

    // /**
    //  * @return Ansewer[] Returns an array of Ansewer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ansewer
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
