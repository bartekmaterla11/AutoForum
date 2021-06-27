<?php

declare(strict_types=1);

namespace App\Query;

use Doctrine\DBAL\Driver\Connection;

class DownloadAppInfoQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function downloadAppInfoUsers(): int
    {
        $sql = 'SELECT count(id) as user_count FROM `user`';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchOne();
    }

    public function downloadAppInfoPost(): int
    {
        $sql = 'SELECT count(id) as posts_count FROM post ';
        $posts = $this->connection->prepare($sql);
        $posts->execute();

        return (int) $posts->fetchOne();
    }

    public function downloadAppInfoAnswer(): int
    {
        $sql = 'SELECT count(id) as answer_count FROM answer ';
        $answers = $this->connection->prepare($sql);
        $answers->execute();

        return (int) $answers->fetchOne();
    }

    public function downloadAppInfoAnnouncement()
    {
        $sql = 'SELECT count(id) as offer_count FROM offer ';
        $offers = $this->connection->prepare($sql);
        $offers->execute();

        return (int) $offers->fetchOne();
    }
}