<?php

declare(strict_types=1);

namespace App\Query\Posts;

use App\Entity\Posts\Post;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;

class NumberOfAnswersOnePostQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function downloadNumberOfAnswersOnePost(Post $post): int
    {
        $sql = ('SELECT count(id) as answers_count FROM answer where post_id = :postId');
        $answer = $this->connection->prepare($sql);
        $answer->bindValue(':postId', $post->getId(), ParameterType::INTEGER);
        $answer->execute();

        return (int) $answer->fetchOne();
    }
}
