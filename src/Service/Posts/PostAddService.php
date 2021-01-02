<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Post;
use App\Query\Posts\PostQuery;
use App\Writer\Posts\PostWriter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PostAddService implements PostInterface
{
    /**
     * @var PostWriter
     */
    private $postWriter;
    /**
     * @var PostQuery
     */
    private $postQuery;

    public function __construct(PostWriter $postWriter, PostQuery $postQuery)
    {
        $this->postWriter = $postWriter;
        $this->postQuery = $postQuery;
    }

    public function addPost(Post $post, FormInterface $form, UserInterface $user): bool
    {
        try {
            if($this->postWriter->addToDataBase($post, $form, $user)){
                return true;
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function removePost(Post $post, $userId): bool
    {
        if($this->postQuery->removePostInDataBase($post, $userId)){
            return true;
        }
        return false;
    }
}