<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Posts\Answer;
use App\Entity\Posts\CommentAnswer;
use App\Query\Posts\CommentAnswerQuery;
use App\Writer\Posts\CommentAnswerWriter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentAnswerService implements CommentAnswerInterface
{
    /**
     * @var CommentAnswerWriter
     */
    private $commentAnswerWriter;
    /**
     * @var CommentAnswerQuery
     */
    private $commentAnswerQuery;

    public function __construct(CommentAnswerWriter $commentAnswerWriter, CommentAnswerQuery $commentAnswerQuery)
    {
        $this->commentAnswerWriter = $commentAnswerWriter;
        $this->commentAnswerQuery = $commentAnswerQuery;
    }

    public function addCommentForAnswer(string $content, UserInterface $user, Answer $answer, CommentAnswer $addComment): bool
    {
        try {
            $this->commentAnswerWriter->addCommentForAnswer($content, $user, $answer, $addComment);
            return true;
        } catch (\Exception $exception) {
            return false;
        }

    }

    public function removeComment(CommentAnswer $comment): bool
    {
        if ($this->commentAnswerQuery->removeCommentInDataBase($comment)) {
            return true;
        }
        return false;
    }

}