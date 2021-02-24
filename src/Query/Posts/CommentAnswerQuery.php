<?php


namespace App\Query\Posts;


use App\Entity\Posts\CommentAnswer;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;

class CommentAnswerQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function removeCommentInDataBase(CommentAnswer $comment)
    {
        $sql = 'DELETE FROM comment_answer WHERE id = :Id';
        $answers = $this->connection->prepare($sql);
        $answers->bindValue(':Id', $comment->getId(), ParameterType::INTEGER);
        $answers->execute();

        return true;
    }
}