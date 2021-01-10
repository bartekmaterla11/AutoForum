<?php

declare(strict_types=1);

namespace App\Writer\Posts;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;

class PostMarkWriter
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(Connection $connection, EntityManagerInterface $entityManager)
    {
        $this->connection = $connection;
        $this->entityManager = $entityManager;
    }


    public function setLikeUpPost(int $postId): void
    {
        $sql='UPDATE post SET like_up = like_up + :mark WHERE id = :postId';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1,'postId'=>$postId]);
    }

    public function setCheckMarkPost(int $userId, int $postId): void
    {
        $sql = 'INSERT INTO check_mark_post SET `user`= :userId, post = :postId';
        $em = $this->connection->prepare($sql);
        $em->bindValue(':userId', $userId, ParameterType::INTEGER);
        $em->bindValue(':postId', $postId, ParameterType::INTEGER);
        $em->execute();

    }

    public function setLikeUpAnswer($answerId): void
    {
        $sql='UPDATE answer SET like_up = like_up + :mark WHERE id = :answerId';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1,'answerId'=>$answerId]);

    }

    public function setCheckMarkAnswer(int $userId, int $answerId): void
    {
        $sql = 'INSERT INTO check_mark_answer SET `user`= :userId, answer = :answerId';
        $em = $this->connection->prepare($sql);
        $em->bindValue(':userId', $userId, ParameterType::INTEGER);
        $em->bindValue(':answerId', $answerId, ParameterType::INTEGER);
        $em->execute();

    }

}