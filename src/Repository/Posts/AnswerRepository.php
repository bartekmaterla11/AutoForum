<?php

namespace App\Repository\Posts;

use App\Entity\Posts\Answer;
use App\Entity\Posts\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }


    // /**
    //  * @return Answer[] Returns an array of Answer objects
    //  */

    public function findByUserComments($answers): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.uploadedAt', 'DESC')
            ->andWhere('a.id IN (:answers)')
            ->setParameter('answers', $answers, Connection::PARAM_INT_ARRAY)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Answer
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
