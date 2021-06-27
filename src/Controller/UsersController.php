<?php

namespace App\Controller;

use App\Entity\User;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{

    /**
     * @var PaginatorInterface
     */
    private $pagination;

    public function __construct(PaginatorInterface $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     *@Route("/uzytkownicy/{page}", name="users")
     * @param int $page
     */
    public function viewAllUsers(int $page): Response
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findByUsers();
        $users = $this->pagination->paginate($users, $page, 6);

        return $this->render('users_list/users.html.twig',[
            'users' => $users,
        ]);
    }
}
