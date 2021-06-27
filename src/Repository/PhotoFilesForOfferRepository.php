<?php

namespace App\Repository;

use App\Entity\PhotoFilesForOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoFilesForOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoFilesForOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoFilesForOffer[]    findAll()
 * @method PhotoFilesForOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoFilesForOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoFilesForOffer::class);
    }

    // /**
    //  * @return PhotoFilesForOffer[] Returns an array of PhotoFilesForOffer objects
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
    public function findOneBySomeField($value): ?PhotoFilesForOffer
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
