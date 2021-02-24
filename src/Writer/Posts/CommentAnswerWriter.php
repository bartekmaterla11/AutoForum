<?php

declare(strict_types=1);

namespace App\Writer\Posts;

use App\Entity\Posts\Answer;
use App\Entity\Posts\CommentAnswer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentAnswerWriter
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addCommentForAnswer(string $content,UserInterface $user, Answer $answer, CommentAnswer $add_comment): bool
    {
        $add_comment->setUser($user);
        $add_comment->setAnswer($answer);
        $add_comment->setContentCom($content);
        $add_comment->setUploadedAt(new \DateTime());

        $em = $this->entityManager;
        $em->persist($add_comment);
        $em->flush();

        return true;
    }
}