<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\AnswerRepository;
use App\Service\AppInfoInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @var AppInfoInterface
     */
    private $appInfo;

    public function __construct(AppInfoInterface $appInfo)
    {
        $this->appInfo = $appInfo;
    }

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