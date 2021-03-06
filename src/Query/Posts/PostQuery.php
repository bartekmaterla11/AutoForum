<?php

declare(strict_types=1);

namespace App\Query\Posts;

use App\Entity\Posts\Post;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;
use Symfony\Component\Filesystem\Filesystem;

class PostQuery
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function removePostInDataBase(Post $post)
    {
        if ($post->getPhotoFilesForPosts()) {
            $array = $post->getPhotoFilesForPosts();
            foreach ($array as $item){
                $file = new Filesystem();
                $file->remove('images/post/' . $item->getFilename());
            }
        }

        $sql = 'DELETE FROM post WHERE id = :Id';
        $posts = $this->connection->prepare($sql);
        $posts->bindValue(':Id', $post->getId(), ParameterType::INTEGER);
        $posts->execute();

        return true;
    }
}
