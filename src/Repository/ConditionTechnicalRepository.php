<?php

namespace App\Repository;

use App\Entity\ConditionTechnical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConditionTechnical|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConditionTechnical|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConditionTechnical[]    findAll()
 * @method ConditionTechnical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionTechnicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionTechnical::class);
    }

    // /**
    //  * @return ConditionTechnical[] Returns an array of ConditionTechnical objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConditionTechnical
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
