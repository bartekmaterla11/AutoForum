<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Form\AnswerPostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnswerPostController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/odpowiedz", name="add_answer")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAnswer(Request $request)
    {
            return $this->render('post/answer/answer_post.html.twig',[

            ]);
    }


}