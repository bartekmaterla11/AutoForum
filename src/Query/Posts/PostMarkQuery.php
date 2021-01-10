<?php

declare(strict_types=1);

namespace App\Query\Posts;


use Doctrine\DBAL\Driver\Connection;

class PostMarkQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function checkMarkPost(int $postId, int $userId): bool
    {
        $sql = 'SELECT EXISTS(SELECT * FROM check_mark_post WHERE `post` = :postId and `user` = :userId) ';

        $em = $this->connection->prepare($sql);
        $em->bindValue(':userId', $userId);
        $em->bindValue(':postId', $postId);
        $em->execute();

        return (bool) $em->fetchOne();
    }

    public function checkMarkAnswer(int $answerId, int $userId): bool
    {
        $sql = 'SELECT EXISTS(SELECT * FROM check_mark_answer WHERE `answer` = :answerId and `user` = :userId) ';

        $em = $this->connection->prepare($sql);
        $em->bindValue(':userId', $userId);
        $em->bindValue(':answerId', $answerId);
        $em->execute();

        return (bool) $em->fetchOne();
    }
}