<?php

declare(strict_types=1);

namespace App\Query\Announcements;

use App\Entity\Offer;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;

class AnnouncementsQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function removeOfferInDataBase(Offer $offer)
    {
        $sql = 'DELETE FROM offer WHERE id = :Id';
        $posts = $this->connection->prepare($sql);
        $posts->bindValue(':Id', $offer->getId(), ParameterType::INTEGER);
        $posts->execute();

        return true;
    }
}