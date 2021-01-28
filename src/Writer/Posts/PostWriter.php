<?php

declare(strict_types=1);

namespace App\Writer\Posts;

use App\Entity\Posts\Post;
use App\Service\ConvertStringToSlug;
use App\Service\PhotoToString;
use App\Service\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
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
    /**
     * @var UploadFileService
     */
    private $uploadFileService;

    public function __construct(EntityManagerInterface $entityManager,PhotoToString $photoToString, ConvertStringToSlug $stringToSlug, UploadFileService $uploadFileService)
    {
        $this->entityManager = $entityManager;
        $this->stringToSlug = $stringToSlug;
        $this->photoToString = $photoToString;
        $this->uploadFileService = $uploadFileService;
    }

    public function addToDataBase(Post $post, FormInterface $form, UserInterface $user): bool
    {
        $filesPost = $form->getData()->getPhotoFilesForPosts();
        if ($filesPost) {
            foreach ($filesPost as $file) {
                $newFileName = $this->uploadFileService->UploadFile($file->getFilename(), 'Name', 'images/post');
                $file->setPost($post);
                $file->setFilename($newFileName);
                $post->addPhotoFilesForPost($file);
            }
        }

        $slug = $form->get('title')->getData();
        $newSlug = $this->stringToSlug->ConversionToSlug($slug);
        $post->setSlug($newSlug);
        $post->setUser($user);
        $post->setTitle($form->get('title')->getData());
        $post->setUploadedAt(new \DateTime());
        $post->setContent($form->get('content')->getData());
        $post->setLikeUp(0);

        $post->setCategory($form->get('category')->getData());

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return true;
    }
}