<?php

namespace App\Repository;

use App\Entity\AttributeValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttributeValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeValue[]    findAll()
 * @method AttributeValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeValue::class);
    }

    // /**
    //  * @return AttributeValue[] Returns an array of AttributeValue objects
    //  */

    public function findByAttributeLocation(int $value)
    {
        return $this->createQueryBuilder('a')
            ->Where('a.offer = :val')
            ->setParameter('val', $value, ParameterType::INTEGER)
            ->andWhere('a.attribute = :id')
            ->setParameter('id', 17, ParameterType::INTEGER)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?AttributeValue
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
