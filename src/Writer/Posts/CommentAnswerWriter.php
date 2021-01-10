<?php

declare(strict_types=1);

namespace App\Writer\Posts;

use App\Entity\Answer;
use App\Entity\CommentAnswer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
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

    public function addCommentForAnswer(FormInterface $commentForm,UserInterface $user, Answer $answerId, CommentAnswer $add_comment): bool
    {
        $add_comment->setUser($user);
        $add_comment->setAnswer($answerId);
        $add_comment->setContentCom($commentForm->get('content_com')->getData());
        $add_comment->setUploadedAt(new \DateTime());
        $add_comment->setLikeUp(0);

        $em = $this->entityManager;
        $em->persist($add_comment);
        $em->flush();

        return true;
    }
}