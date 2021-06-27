<?php

namespace App\Repository;

use App\Entity\CheckLikeOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckLikeOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckLikeOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckLikeOffer[]    findAll()
 * @method CheckLikeOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckLikeOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckLikeOffer::class);
    }

    // /**
    //  * @return CheckLikeOffer[] Returns an array of CheckLikeOffer objects
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
    public function findOneBySomeField($value): ?CheckLikeOffer
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
