<?php

namespace App\Repository;

use App\Entity\CommentAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentAnswer[]    findAll()
 * @method CommentAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentAnswer::class);
    }

    // /**
    //  * @return CommentAnswer[] Returns an array of CommentAnswer objects
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
    public function findOneBySomeField($value): ?CommentAnswer
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
