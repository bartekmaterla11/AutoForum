<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Answer;
use App\Entity\Post;
use App\Query\Posts\AnswerQuery;
use App\Writer\Posts\AnswerPostWriter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AnswerAddService implements AnswerAddInterface
{
    /**
     * @var AnswerPostWriter
     */
    private $answerWriter;
    /**
     * @var AnswerQuery
     */
    private $answerQuery;

    public function __construct(AnswerPostWriter $answerWriter, AnswerQuery $answerQuery)
    {
        $this->answerWriter = $answerWriter;
        $this->answerQuery = $answerQuery;
    }

    public function addAnswerPost(FormInterface $form, Answer $add_answer, UserInterface $user, Post $post): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->answerWriter->addAnswerToDataBase($form, $add_answer, $user, $post);

            } catch (\Exception $exception) {
                return false;
            }
        }
        return false;
    }

    public function removeAnswer(Answer $answer): bool
    {
        if ($this->answerQuery->removeAnswerInDataBase($answer)) {
            return true;
        }
        return false;
    }
}
