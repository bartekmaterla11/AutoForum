<?php

namespace App\Service\Posts;

use App\Entity\Posts\Post;

interface NumberOfAnswerOnePostInterface
{
    public function getNumberOfAnswers(Post $postId): array;
}