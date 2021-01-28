<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Enum\PostMarkEnum;
use App\Query\Posts\PostMarkQuery;
use App\Writer\Posts\PostMarkWriter;

class PostMarkService implements PostMarkInterface
{
    /**
     * @var PostMarkWriter
     */
    private $postMarkWriter;
    /**
     * @var PostMarkQuery
     */
    private $postMarkQuery;

    public function __construct(PostMarkWriter $postMarkWriter, PostMarkQuery $postMarkQuery)
    {
        $this->postMarkWriter = $postMarkWriter;
        $this->postMarkQuery = $postMarkQuery;
    }

    public function addMarkForPost(int $mark, int $postId, int $userId): bool
    {
        if ($mark === PostMarkEnum::MARK_UP) {
            if ($this->postMarkQuery->checkMarkPost($postId, $userId)){
                return false;
            } else {
                $this->postMarkWriter->setLikeUpPost($postId);
                $this->postMarkWriter->setCheckMarkPost($userId, $postId);
                return true;
            }
        }
        return false;
    }

    public function addMarkForAnswer(int $mark, int $answerId, int $userId): bool
    {
        if($mark === PostMarkEnum::MARK_UP){
            if($this->postMarkQuery->checkMarkAnswer($answerId, $userId)){
                return false;
            }else {
                $this->postMarkWriter->setLikeUpAnswer($answerId);
                $this->postMarkWriter->setCheckMarkAnswer($userId, $answerId);
                return true;
            }
        }
    }
//    public function checkAddMarkPost()
//    {
//
//    }
}
