<?php

namespace App\Repository;

use App\Entity\TypeParts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeParts|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeParts|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeParts[]    findAll()
 * @method TypeParts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePartsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeParts::class);
    }

    // /**
    //  * @return TypeParts[] Returns an array of TypeParts objects
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
    public function findOneBySomeField($value): ?TypeParts
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
