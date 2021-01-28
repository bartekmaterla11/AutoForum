<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     *@Route("/uzytkownicy", name="users")
     */
    public function viewAllUsers(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findByUsers();

        return $this->render('users_list/users.html.twig',[
            'users' => $users
        ]);
    }
}
