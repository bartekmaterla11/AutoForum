<?php

declare(strict_types=1);

namespace App\Writer\Posts;

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


    public function setLikeUpPost(int $postId): void
    {
        $sql='UPDATE post SET like_up = like_up + :mark WHERE id = :postId';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1,'postId'=>$postId]);

//        $this->decreaseLikeDown();
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

    public function setLikeUpAnswer($answerId): void
    {
        $sql='UPDATE answer SET like_up = like_up + :mark WHERE id = :answerId';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['mark'=> 1,'answerId'=>$answerId]);

    }

}