<?php

declare(strict_types=1);

namespace App\Service\Posts;

interface PostMarkInterface
{
    public function addMarkForPost(int $mark, int $postId);
    public function addMarkForAnswer(int $mark, int $answerId);
}