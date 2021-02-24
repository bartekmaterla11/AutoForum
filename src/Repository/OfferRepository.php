<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
    //  */

    public function findByAll()
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByOfferByIndex(): ?array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCategoryOffers(int $value): array
    {
        return $this->createQueryBuilder('o')

            ->andWhere('o.template = :val')
            ->setParameter('val', $value, ParameterType::INTEGER)
            ->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

}
