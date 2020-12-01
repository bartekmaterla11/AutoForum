<?php

declare(strict_types=1);

namespace App\Writer;


use Doctrine\DBAL\Driver\Connection;

class PostMarkWriter
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    public function setLikeUp(): void
    {
        $sql='UPDATE post SET like_up = like_up + :mark WHERE id = 1';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1]);


        $this->decreaseLikeDown();
    }

    public function setLikeDown(): void
    {
        $sql='UPDATE post SET like_down = like_down + :mark WHERE id = 1';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1]);

        $this->decreaseLikeUp();
    }

    private function decreaseLikeUp(): void
    {
        $sql='UPDATE post SET like_up = like_up - :mark WHERE id = 1';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1]);
    }

    private function decreaseLikeDown(): void
    {
        $sql='UPDATE post SET like_down = like_down - :mark WHERE id = 1';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1]);
    }

}