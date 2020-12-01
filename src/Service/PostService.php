<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Post;
use App\Writer\PostWriter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class PostService implements PostInterface
{
    /**
     * @var PostWriter
     */
    private $postWriter;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(PostWriter $postWriter, EntityManagerInterface $entityManager)
    {
        $this->postWriter = $postWriter;
        $this->entityManager = $entityManager;
    }

    public function addPost(Post $post, FormInterface $form, UserInterface $user)
    {
        try {
//            /** @var UploadedFile $pictureFileName */
            $pictureFileName = $form->get('filename')->getData();
//            $slug = $form->get('title')->getData();
//            $newSlug = $this->ConversionToSlug($slug);
            if($pictureFileName) {
                $newFileName = $this->PhotoPostToString($pictureFileName);
            }
//            $this->postWriter->addToDataBase($post, $form, $user,$pictureFileName, $newFileName, $newSlug);



            if ($form->get('filename')->getData()) {

                $pictureFileName->move('images/post', $newFileName);
                $post->setFilename($newFileName);
            }

            $slug = $form->get('title')->getData();
            $newSlug = $this->ConversionToSlug($slug);
            $post->setSlug($newSlug);

            $post->setUser($user);
            $post->setTitle($form->get('title')->getData());
            $post->setUploadedAt(new\DateTime());
            $post->setContent($form->get('content')->getData());
            $post->setLikeUp(0);
            $post->setLikeDown(0);

            $this->entityManager->persist($post);
            $this->entityManager->flush();

            return true;

        } catch (\Exception $exception) {
            return false;
        }
    }

    public function ConversionToSlug(string $slug): string
    {
        $lowerSlug = strtolower($slug);
        $aa = [" ", "?", "!"];
        $bb = ["-", " ", " "];
        $newSlug = str_replace($aa, $bb, $lowerSlug);

        return $newSlug;
    }


    /** @var UploadedFile $pictureFileName */
    public function PhotoPostToString($pictureFileName): string
    {
        $originalfileName = pathinfo($pictureFileName->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalfileName);
        $newFileName = $safeFileName . '-' . uniqid() . '.' . $pictureFileName->guessExtension();

        return $newFileName;
    }

}