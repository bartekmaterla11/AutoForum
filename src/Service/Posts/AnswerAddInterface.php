<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Answer;
use App\Entity\Post;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface AnswerAddInterface
{
    public function addAnswerPost(FormInterface $form, Answer $add_answer, UserInterface $user, Post $post): bool;
}