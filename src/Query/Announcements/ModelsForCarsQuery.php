<?php

declare(strict_types=1);

namespace App\Query\Announcements;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;

class ModelsForCarsQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function queryForModelOfCars(int $id): array
    {
        $sql = 'SELECT * FROM `model_of_cars` where mark_id = :id';
        $array = $this->connection->prepare($sql);
        $array->bindValue(':id', $id, ParameterType::INTEGER);
        $array->execute();

        return array_values($array->fetchAll());
    }

    public function queryForMarkVanstrucks(int $id): array
    {
        $sql = 'SELECT * FROM `mark_of_vans_and_trucks` where children_category_id = :id';
        $array = $this->connection->prepare($sql);
        $array->bindValue(':id', $id, ParameterType::INTEGER);
        $array->execute();

        return array_values($array->fetchAll());
    }

    public function queryForTypeParts(int $id): array
    {
        $sql = 'SELECT * FROM `type_parts` where belong = 0 OR belong = :id';
        $array = $this->connection->prepare($sql);
        $array->bindValue(':id', $id, ParameterType::INTEGER);
        $array->execute();

        return array_values($array->fetchAll());
    }
}