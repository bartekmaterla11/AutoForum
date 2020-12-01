<?php

namespace App\Service;

use App\Entity\Post;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface PostInterface
{
    public function PhotoPostToString($pictureFileName): string;
    public function ConversionToSlug(string $slug): string;
    public function addPost(Post $post, FormInterface $form, UserInterface $user);

}