<?php

namespace App\Repository;

use App\Entity\ModelOfCars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModelOfCars|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelOfCars|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelOfCars[]    findAll()
 * @method ModelOfCars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelOfCarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelOfCars::class);
    }

    // /**
    //  * @return ModelOfCars[] Returns an array of ModelOfCars objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModelOfCars
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
