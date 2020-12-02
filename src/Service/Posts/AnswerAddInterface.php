<?php


namespace App\Service;

use App\Entity\Answer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface AnswerAddInterface
{
    public function addAnswerPost(FormInterface $form, Answer $add_answer, UserInterface $user);
}