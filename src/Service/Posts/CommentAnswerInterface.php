<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\CommentAnswer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface CommentAnswerInterface
{
    public function addCommentForAnswer(FormInterface $commentForm, UserInterface $user, $answerId, CommentAnswer $add_comment): bool;
}