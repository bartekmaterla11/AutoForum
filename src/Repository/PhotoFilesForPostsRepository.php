<?php

namespace App\Repository;

use App\Entity\PhotoFilesForPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoFilesForPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoFilesForPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoFilesForPosts[]    findAll()
 * @method PhotoFilesForPosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoFilesForPostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoFilesForPosts::class);
    }

    // /**
    //  * @return PhotoFilesForPosts[] Returns an array of PhotoFilesForPosts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PhotoFilesForPosts
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
