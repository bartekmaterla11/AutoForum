<?php

namespace App\Repository;

use App\Entity\ChildrenCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChildrenCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChildrenCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChildrenCategory[]    findAll()
 * @method ChildrenCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChildrenCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChildrenCategory::class);
    }

    // /**
    //  * @return ChildrenCategory[] Returns an array of ChildrenCategory objects
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
    public function findOneBySomeField($value): ?ChildrenCategory
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
