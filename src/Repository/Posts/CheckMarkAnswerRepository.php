<?php

namespace App\Repository\Posts;

use App\Entity\Posts\CheckMarkAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckMarkAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckMarkAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckMarkAnswer[]    findAll()
 * @method CheckMarkAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckMarkAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckMarkAnswer::class);
    }

    // /**
    //  * @return CheckMarkAnswer[] Returns an array of CheckMarkAnswer objects
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
    public function findOneBySomeField($value): ?CheckMarkAnswer
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
