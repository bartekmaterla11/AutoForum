<?php

declare(strict_types=1);

namespace App\Writer\Announcements;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;

class OffersLikeWriter
{
    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function addLikeToDataBase(int $userId, int $offerId): bool
    {
        $sql = 'INSERT INTO check_like_offer SET `user` = :userId, `offer` = :offerId ';
        $em = $this->connection->prepare($sql);
        $em->bindValue(':userId', $userId, ParameterType::INTEGER);
        $em->bindValue(':offerId', $offerId, ParameterType::INTEGER);
        $em->execute();

        return true;
    }

    public function removeLikeInDataBase(int $userId, int $offerId): bool
    {
        $sql = 'DELETE FROM check_like_offer WHERE `user` = :userId AND `offer` = :offerId ';
        $em = $this->connection->prepare($sql);
        $em->bindValue(':userId', $userId, ParameterType::INTEGER);
        $em->bindValue(':offerId', $offerId, ParameterType::INTEGER);
        $em->execute();

        return true;
    }
}