<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Answer;
use App\Writer\AnswerPostWriter;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AnswerAddService implements AnswerAddInterface
{
    /**
     * @var PhotoToString
     */
    private $photoToString;
    /**
     * @var AnswerPostWriter
     */
    private $postWriter;

    public function __construct( PhotoToString $photoToString, AnswerPostWriter $postWriter)
    {
        $this->photoToString = $photoToString;
        $this->postWriter = $postWriter;
    }

    public function addAnswerPost(FormInterface $form, Answer $add_answer, UserInterface $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->postWriter->addAnswerToDataBase($form, $add_answer, $user);

            } catch (\Exception $exception) {
                return false;
            }
        }
    }
}