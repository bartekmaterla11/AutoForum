<?php

namespace App\Repository\Posts;

use App\Entity\Posts\CategoryPost;
use App\Entity\Posts\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */

    public function findByAllPosts(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.uploaded_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByAllPostsUser(int $userId): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.uploaded_at', 'DESC')
            ->where('p.user = :id')
            ->setParameter('id', $userId, ParameterType::INTEGER)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByCategoryPosts(string $slug): ?array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin(CategoryPost::class, 'cp', Join::WITH,'cp.id = p.category')
            ->where('cp.slug = :slug')
            ->setParameter('slug', $slug, ParameterType::STRING)
            ->orderBy('p.uploaded_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByPostsForIndex(): ?array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.uploaded_at', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByPostsLikePost(int $id, int $postId): ?array
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :id')
            ->andWhere('p.id != :postId')
            ->setParameter('id', $id, ParameterType::INTEGER)
            ->setParameter('postId', $postId, ParameterType::INTEGER)
            ->orderBy('p.uploaded_at', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByUserPosts(array $posts): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id IN (:posts)')
            ->setParameter('posts', $posts, Connection::PARAM_INT_ARRAY)
            ->orderBy('p.uploaded_at', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
