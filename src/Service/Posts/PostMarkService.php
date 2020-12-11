<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Enum\PostMarkEnum;
use App\Writer\Posts\PostMarkWriter;

class PostMarkService implements PostMarkInterface
{
    /**
     * @var PostMarkWriter
     */
    private $postMarkWriter;

    public function __construct(PostMarkWriter $postMarkWriter)
    {
        $this->postMarkWriter = $postMarkWriter;
    }

    public function addMarkForPost(int $mark, int $postId): void
    {
        if ($mark === PostMarkEnum::MARK_UP) {
            $this->postMarkWriter->setLikeUpPost($postId);
            return;
        }
        $this->postMarkWriter->setLikeDown($postId);
    }

    public function addMarkForAnswer(int $mark, int $answerId): void
    {
        if($mark === PostMarkEnum::MARK_UP){
            $this->postMarkWriter->setLikeUpAnswer($answerId);
            return;
        }
    }
//    public function checkAddMarkPost()
//    {
//
//    }
}
