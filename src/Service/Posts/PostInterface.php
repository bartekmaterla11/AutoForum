<?php

namespace App\Service;

use App\Entity\Answer;
use App\Entity\Post;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface PostInterface
{
    public function addPost(Post $post, FormInterface $form, UserInterface $user);

}
