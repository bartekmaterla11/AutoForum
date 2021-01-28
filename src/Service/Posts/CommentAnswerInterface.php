<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Posts\Answer;
use App\Entity\Posts\CommentAnswer;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface CommentAnswerInterface
{
    public function addCommentForAnswer(FormInterface $commentForm, UserInterface $user, Answer $answerId, CommentAnswer $add_comment): bool;
}