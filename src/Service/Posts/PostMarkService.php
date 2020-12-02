<?php

declare(strict_types=1);


namespace App\Service;

use App\Enum\PostMarkEnum;
use App\Writer\PostMarkWriter;

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

    public function addMarkForPost(int $mark): void
    {
        if ($mark === PostMarkEnum::MARK_UP) {
            $this->postMarkWriter->setLikeUp();
            return;
        }
//        return true//false;
        $this->postMarkWriter->setLikeDown();
    }

    public function checkAddMarkPost()
    {

    }
}
