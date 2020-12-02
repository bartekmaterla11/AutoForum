<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Answer;
use App\Form\AnswerPostFormType;
use App\Form\PostFormType;
use App\Service\AnswerAddInterface;
use App\Service\PostInterface;
use App\Service\PostMarkService;
use App\Service\PostService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @var PostMarkService
     */
    private $postMarkService;
    /**
     * @var PostInterface
     */
    private $addPost;
    /**
     * @var AnswerAddInterface
     */
    private $answerAdd;


    public function __construct(PostMarkService $postMarkService, PostInterface $addPost, AnswerAddInterface $answerAdd)
    {
        $this->postMarkService = $postMarkService;
        $this->addPost = $addPost;
        $this->answerAdd = $answerAdd;
    }

    /**
     * @param Request $request
     * @Route("/dodaj-post", name="add_post")
     */
    public function post(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->addPost->addPost($post, $form, $this->getUser())) {
                $this->addFlash('success', 'Pytanie zostało dodane poprawnie');

                return $this->redirectToRoute('index');
            }
            $this->addFlash('error1', 'Ups, Wystąpił błąd. Nie udało się dodać posta, spróbuj jeszcze raz.');
        }

        return $this->render('post/addPost/add.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/forum/{slug}", name="view_post")
     * @param string $slug
     * @param int $id
     */
    public function viewPost($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findBy(['slug' => $slug]);

        if ($this->getUser()) {
            $add_answer = new Answer();
            $form = $this->createForm(AnswerPostFormType::class, $add_answer);
            $form->handleRequest($request);

            if($this->answerAdd->addAnswerPost($form, $add_answer, $this->getUser())){

                $this->addFlash('error2', 'Wystąpił bład przy dodawaniu komentarza');
            }
            $this->addFlash('error2', 'Wystąpił bład przy dodawaniu komentarza');

            if ($post) {
                return $this->render('post/viewPost/view_post.html.twig', [
                    'posts' => $post,
                    'answerForm' => $form->createView(),
                ]);
            }
        }
        if (!$this->getUser()) {
            return $this->render('post/viewPost/view_post.html.twig', [
                'posts' => $post,
            ]);
        }
    }
}


        //'answers' => $answers
//                'iscommeted' => $wyunik,
//                'annonymus'=>

//        $wynik = $this->postMarkService->checkAddMarkPost();
        //zapytanie  do bazy po rekordy z nowej tabeli , wehere userid  and postid
//
//        $wyunik = 1 => true
//        $wyunik = 0 => false
//
//        foreach (wyniki as wynik)
//        {
//            [
//                'post' => $post
//            ]
//        }



