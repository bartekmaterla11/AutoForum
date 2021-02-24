<?php

namespace App\Repository;

use App\Entity\Overbody;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Overbody|null find($id, $lockMode = null, $lockVersion = null)
 * @method Overbody|null findOneBy(array $criteria, array $orderBy = null)
 * @method Overbody[]    findAll()
 * @method Overbody[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OverbodyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Overbody::class);
    }

    // /**
    //  * @return Overbody[] Returns an array of Overbody objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Overbody
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
