<?php

namespace App\Service\Posts;

use App\Entity\Post;

interface NumberOfAnswerOnePostInterface
{
    public function getNumberOfAnswers($postId): array;
}