<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Post;
use App\Writer\Posts\PostWriter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PostAddService implements PostInterface
{
    /**
     * @var PostWriter
     */
    private $postWriter;

    public function __construct(PostWriter $postWriter)
    {
        $this->postWriter = $postWriter;
    }

    public function addPost(Post $post, FormInterface $form, UserInterface $user): bool
    {
        try {
            $this->postWriter->addToDataBase($post, $form, $user);

        } catch (\Exception $exception) {
            return false;
        }
    }
}