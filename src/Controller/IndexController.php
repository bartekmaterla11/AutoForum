<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var $post Post
         */
        $posts = $em->getRepository(Post::class)->findAll();

        return $this->render('index/index.html.twig', [
            'posts' => $posts]
        );
    }
}
