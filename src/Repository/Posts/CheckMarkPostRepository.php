<?php

namespace App\Repository\Posts;

use App\Entity\Posts\CheckMarkPost;
use App\Entity\Posts\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckMarkPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckMarkPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckMarkPost[]    findAll()
 * @method CheckMarkPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckMarkPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckMarkPost::class);
    }

    // /**
    //  * @return CheckMarkPost[] Returns an array of CheckMarkPost objects
    //  */

//    public function findByLikePost($value)
//    {
//        return $this->createQueryBuilder('o')
//            ->leftJoin(Post::class,'p', Join::WITH, 'p.id = o.post')
//            ->select('o.post')
//            ->Where('o.user = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    /*
    public function findOneBySomeField($value): ?CheckMarkPost
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
