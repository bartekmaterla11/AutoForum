<?php

declare(strict_types=1);

namespace App\Writer;

use App\Entity\Post;
use App\Service\PostService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class PostWriter
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addToDataBase(Post $post, FormInterface $form, UserInterface $user,?UploadedFile $pictureFileName, $newFileName, $newSlug): bool
    {
        if ($form->get('filename')->getData()) {
            $pictureFileName->move('images/post', $newFileName);
            $post->setFilename($newFileName);
        }

        $post->setSlug($newSlug);
        $post->setUser($user);
        $post->setTitle($form->get('title')->getData());
        $post->setUploadedAt(new\DateTime());
        $post->setContent($form->get('content')->getData());
        $post->setLikeUp(0);
        $post->setLikeDown(0);
        $post->addAnswer(0);

        $em = $this->entityManager;
        $em->persist($post);
        $em->flush();

        return true;
    }

}