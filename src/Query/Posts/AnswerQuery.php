<?php

declare(strict_types=1);

namespace App\Query\Posts;

use App\Entity\Posts\Answer;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;
use Symfony\Component\Filesystem\Filesystem;

class AnswerQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function removeAnswerInDataBase(Answer $answer)
    {
        if ($answer->getFile()) {
            $file = new Filesystem();
            $file->remove('images/post/answer/' . $answer->getFile());
        }

        $sql = 'DELETE FROM answer WHERE id = :Id';
        $answers = $this->connection->prepare($sql);
        $answers->bindValue(':Id', $answer->getId(), ParameterType::INTEGER);
        $answers->execute();

        return true;
    }
}