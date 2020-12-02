<?php

declare(strict_types=1);

namespace App\Writer;

use App\Entity\Answer;
use App\Service\PhotoToString;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AnswerPostWriter
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var PhotoToString
     */
    private $photoToString;

    public function __construct(EntityManagerInterface $entityManager, PhotoToString $photoToString)
    {
        $this->entityManager = $entityManager;
        $this->photoToString = $photoToString;
    }

    public function addAnswerToDataBase(FormInterface $form, Answer $add_answer, UserInterface $user): bool
    {
        $add_answer->setUser($user);
        $add_answer->setPost();
        $add_answer->setContent($form->get('content')->getData());
        $add_answer->setUploadedAt(new \DateTime());
        $pictureFileName = $form->get('file')->getData();
        if ($pictureFileName) {
            $newFileName = $this->photoToString->PhotoPostToString($pictureFileName);
            $pictureFileName->move('images/post/answer', $newFileName);
            $add_answer->setFile($newFileName);
        }
        $em = $this->entityManager;
        $em->persist($add_answer);
        $em->flush();

        return true;
    }

}