<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Posts\Answer;
use App\Entity\Posts\CommentAnswer;
use Symfony\Component\Security\Core\User\UserInterface;

interface CommentAnswerInterface
{
    public function addCommentForAnswer(string $content, UserInterface $user, Answer $answer, CommentAnswer $add_comment): bool;

    public function removeComment(CommentAnswer $comment): bool;
}