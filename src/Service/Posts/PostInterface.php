<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface PostInterface
{
    public function addPost(Post $post, FormInterface $form, UserInterface $user): bool;

    public function removePost(Post $post, $userId): bool;

}
