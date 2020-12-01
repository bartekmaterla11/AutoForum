<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoAppController extends AbstractController
{
    public function infoApp()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->find;
        $posts = $em->getRepository(Post::class)->find();
        $answer = $em->getRepository(Answer::class)->find();

        $data = new \DateTime();
        $data->modify();
        foreach ($users as $user){

        }

       return $this->render('components/info_data_com.html.twig',[
            'users'=>$users,
           'posts'=>$posts,
           'answers'=>$answer
           ]);
    }
}