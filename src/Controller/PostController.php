<?php

namespace App\Controller;

use App\Entity\CommentAnswer;
use App\Entity\Post;
use App\Entity\Answer;
use App\Form\AnswerPostFormType;
use App\Form\CommentAnswerFormType;
use App\Form\PostFormType;
use App\Service\Posts\AnswerAddInterface;
use App\Service\Posts\CommentAnswerInterface;
use App\Service\Posts\NumberOfAnswerOnePostInterface;
use App\Service\Posts\PostInterface;
use App\Service\Posts\PostMarkService;
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
    /**
     * @var NumberOfAnswerOnePostInterface
     */
    private $numberOfAnswerOnePost;
    /**
     * @var CommentAnswerInterface
     */
    private $commentAnswer;


    public function __construct(CommentAnswerInterface $commentAnswer, NumberOfAnswerOnePostInterface $numberOfAnswerOnePost, PostMarkService $postMarkService, PostInterface $addPost, AnswerAddInterface $answerAdd)
    {
        $this->postMarkService = $postMarkService;
        $this->addPost = $addPost;
        $this->answerAdd = $answerAdd;
        $this->numberOfAnswerOnePost = $numberOfAnswerOnePost;
        $this->commentAnswer = $commentAnswer;
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
                $this->addFlash('success_post', 'Pytanie zostało dodane poprawnie');

                return $this->redirectToRoute('index');
            }
            $this->addFlash('error_post', 'Ups, Wystąpił błąd. Nie udało się dodać posta, spróbuj jeszcze raz.');
        }

        return $this->render('post/addPost/add.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/forum/{slug}", name="view_post")
     * @param string $slug
     */
    public function viewPost($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findOneBy(['slug' => $slug]);
        $numbers = $this->numberOfAnswerOnePost->getNumberOfAnswers($post->getId());

        if ($this->getUser() && $post) {
            $add_answer = new Answer();
            $form = $this->createForm(AnswerPostFormType::class, $add_answer);
            $form->handleRequest($request);

            if ($this->answerAdd->addAnswerPost($form, $add_answer, $this->getUser(), $post)) {

                $this->addFlash('success-answer', 'Poprawnie dodano odpowiedź');
                $this->redirectToRoute('view_post');
            }
            $this->addFlash('error_answer', 'Wystąpił bład przy dodawaniu odpowiedzi');

            $answer = $em->getRepository(Answer::class)->findBy(['post'=>$post->getId()]);

            if($answer){
                $add_comment = new CommentAnswer();
                $commentForm = $this->createForm(CommentAnswerFormType::class, $add_comment);

                foreach ($answer as $item) {
                    if ($this->commentAnswer->addCommentForAnswer($commentForm, $this->getUser(), $item->getId(), $add_comment)) {
                        $this->addFlash('success-comment', 'Poprawnie dodano komentarz');
                    }
                    $this->addFlash('error_comment', 'Wystąpił bład przy dodawaniu komentarza');
                }

                return $this->render('post/viewPost/view_post.html.twig', [
                    'post' => $post,
                    'answerForm' => $form->createView(),
                    'numbers' => $numbers,
                    'commentForm' => $commentForm->createView(),
                ]);
            }

            return $this->render('post/viewPost/view_post.html.twig', [
                'post' => $post,
                'answerForm' => $form->createView(),
                'numbers' => $numbers,
            ]);
        }

        return $this->render('post/viewPost/view_post.html.twig', [
            'post' => $post,
            'numbers' => $numbers
        ]);
    }

    /**
     * @Route("/uzytkownicy/{userId}/moj-profil/{userTab}/{postId}/usuwanie-posta", name="remove_post")
     * @param int $postId
     * @param int $userId
     * @param string $userTab
     */
    public function removePost(int $postId, int $userId, string $userTab)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findOneBy(['id'=>$postId]);

        if($this->addPost->removePost($post, $userId)){
            $this->addFlash('success_remove_post','Post został usunięty');
        }else{
            $this->addFlash('error_remove_post','Post nie został usunięty');
        }
      
        return $this->redirectToRoute('profile',['userId'=>$userId, 'userTab'=>$userTab]);
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



