<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Answer;
use App\Entity\CommentAnswer;
use App\Writer\Posts\CommentAnswerWriter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentAnswerService implements CommentAnswerInterface
{
    /**
     * @var CommentAnswerWriter
     */
    private $commentAnswerWriter;

    public function __construct(CommentAnswerWriter $commentAnswerWriter)
    {
        $this->commentAnswerWriter = $commentAnswerWriter;
    }

    public function addCommentForAnswer(FormInterface $commentForm,UserInterface $user, $answerId,CommentAnswer $add_comment): bool
    {
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            try {
                $this->commentAnswerWriter->addCommentForAnswer($commentForm, $user, $answerId, $add_comment);

            } catch (\Exception $exception) {
                return false;
            }
        }
        return false;
    }

}