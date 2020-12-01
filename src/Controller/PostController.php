<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Answer;
use App\Form\AnswerPostFormType;
use App\Form\PostFormType;
use App\Service\PostInterface;
use App\Service\PostMarkService;
use App\Service\PostService;
use phpDocumentor\Reflection\Types\This;
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
     * @var PostService
     */
    private $postService;
    /**
     * @var PostInterface
     */
    private $addPost;


    public function __construct(PostMarkService $postMarkService, PostInterface $postService, PostInterface $addPost)
    {
        $this->postMarkService = $postMarkService;
        $this->postService = $postService;
        $this->addPost = $addPost;
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
            $this->addFlash('error1', 'Ups, Wystąpił błąd');
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
        /**
         * @var $post Post
         */
        $post = $em->getRepository(Post::class)->findBy(['slug' => $slug]);
        // $answers = $em->getRepository(Answer::class)->findBy();
        if ($this->getUser()) {
            $add_answer = new Answer();
            $form = $this->createForm(AnswerPostFormType::class, $add_answer);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if ($form->isSubmitted() && $form->isValid()) {
                try {
                    $add_answer->setUser($this->getUser());
                    $add_answer->setPost();
                    $add_answer->setContent($form->get('content')->getData());
                    $add_answer->setUploadedAt(new \DateTime());
                    $pictureFileName = $form->get('file')->getData();
                    if ($pictureFileName) {
                        $newFileName = $this->postService->PhotoPostToString($pictureFileName);
                        $pictureFileName->move('images/post/answer', $newFileName);
                        $add_answer->setFile($newFileName);
                    }
                    $em->persist($add_answer);
                    $em->flush();

                } catch (\Exception $exception) {
                    $this->addFlash('error2', 'Wystąpił bład przy dodawaniu komentarza');
                }
            }
            if ($post && $add_answer) {
                return $this->render('post/viewPost/view_post.html.twig', [
                    'posts' => $post,
                    'answerForm' => $form->createView(),
                ]);
            }
        }
        if ($this->getUser() == 0) {
            return $this->render('post/viewPost/view_post.html.twig', [
                'posts' => $post,
                //'answers' => $answers
//                'iscommeted' => $wyunik,
//                'annonymus'=>
            ]);
        }
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


    }
}
