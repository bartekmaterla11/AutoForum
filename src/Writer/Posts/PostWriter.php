<?php

declare(strict_types=1);

namespace App\Writer\Posts;

use App\Entity\Post;
use App\Service\ConvertStringToSlug;
use App\Service\PhotoToString;
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
    /**
     * @var ConvertStringToSlug
     */
    private $stringToSlug;
    /**
     * @var PhotoToString
     */
    private $photoToString;

    public function __construct(EntityManagerInterface $entityManager,PhotoToString $photoToString, ConvertStringToSlug $stringToSlug)
    {
        $this->entityManager = $entityManager;
        $this->stringToSlug = $stringToSlug;
        $this->photoToString = $photoToString;
    }

    public function addToDataBase(Post $post, FormInterface $form, UserInterface $user): bool
    {
        /** @var UploadedFile $pictureFileName */
        $pictureFileName = $form->get('filename')->getData();
        if ($form->get('filename')->getData()) {
            $newFileName = $this->photoToString->PhotoPostToString($pictureFileName);
            $pictureFileName->move('images/post', $newFileName);
            $post->setFilename($newFileName);
        }
        $slug = $form->get('title')->getData();
        $newSlug = $this->stringToSlug->ConversionToSlug($slug);
        $post->setSlug($newSlug);
        $post->setUser($user);
        $post->setTitle($form->get('title')->getData());
        $post->setUploadedAt(new\DateTime());
        $post->setContent($form->get('content')->getData());
        $post->setLikeUp(0);
        $post->setLikeDown(0);

        $em = $this->entityManager;
        $em->persist($post);
        $em->flush();

        return true;
    }

}