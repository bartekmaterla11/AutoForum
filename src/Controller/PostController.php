<?php

namespace App\Controller;

use App\Entity\CategoryPost;
use App\Entity\CommentAnswer;
use App\Entity\Post;
use App\Entity\Answer;
use App\Form\AnswerPostFormType;
use App\Form\CommentAnswerFormType;
use App\Form\PostFormType;
use App\Query\Posts\PostQuery;
use App\Repository\CategoryPostRepository;
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
     * @var NumberOfAnswerOnePostInterface
     */
    private $numberOfAnswerOnePost;
    /**
     * @var CommentAnswerInterface
     */
    private $commentAnswer;
    /**
     * @var PostInterface
     */
    private $post;
    /**
     * @var AnswerAddInterface
     */
    private $answer;
    /**
     * @var PostQuery
     */
    private $postQuery;


    public function __construct(PostQuery $postQuery, CommentAnswerInterface $commentAnswer, NumberOfAnswerOnePostInterface $numberOfAnswerOnePost, PostMarkService $postMarkService, PostInterface $post, AnswerAddInterface $answer)
    {
        $this->postMarkService = $postMarkService;
        $this->numberOfAnswerOnePost = $numberOfAnswerOnePost;
        $this->commentAnswer = $commentAnswer;
        $this->post = $post;
        $this->answer = $answer;
        $this->postQuery = $postQuery;
    }

    /**
     * @param Request $request
     * @Route("/forum/dodaj-post", name="add_post")
     */
    public function post(Request $request): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('index');
        }
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->post->addPost($post, $form, $this->getUser())) {
                $this->addFlash('success_post', 'Pytanie zostało dodane poprawnie');

                return $this->redirectToRoute('forum');
            }
            $this->addFlash('error_post', 'Wystąpił błąd. Spróbuj jeszcze raz.');
        }

        return $this->render('post/addPost/add.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/forum/category/ajax", name="category_change")
     */
    public function changeCategory(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = (int) $request->get('option');

        if ($category > 1) {
            $category = $em->getRepository(CategoryPost::class)->find($category);

            return $this->json(['categorySlug' => $category->getSlug()]);
        }else{
            return $this->json(['categorySlug' => ' ']);
        }
    }

    /**
     * @param Request $request
     * @Route("/forum", name="forum")
     */
    public function homepage()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findByAllPosts();
        $categories = $em->getRepository(CategoryPost::class)->findAll();
        return $this->render('post/index/index_post.html.twig', [
            'posts' => $posts ,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/forum/{categorySlug}", name="forum_sorted")
     */
    public function forum(Request $request, string $categorySlug)
    {
        $a = strlen($categorySlug);
        $em = $this->getDoctrine()->getManager();
        if ($a > 0){
            $posts = $em->getRepository(Post::class)->findByCategoryPosts($categorySlug);
        }else{
            $posts = $em->getRepository(Post::class)->findByAllPosts();
        }
        $categories = $em->getRepository(CategoryPost::class)->findAll();

        if($posts){
            return $this->render('post/index/index_post.html.twig', [
                'posts' => $posts,
                'categories' => $categories,
                'slug' => $categorySlug
            ]);
        }else {
            $this->addFlash('faults', 'Nie znaleziono postów z tej kategorii');

            return $this->render('post/index/index_post.html.twig', [
                'categories' => $categories,
                'slug' => $categorySlug
            ]);
        }
    }

    /**
     * @Route("/forum/{categorySlug}/{slug}", name="view_post")
     * @param string $slug
     * @param string $categorySlug
     */
    public function viewPost(string $slug, Request $request, string $categorySlug)
    {
        $em = $this->getDoctrine()->getManager();
        $postRep = $em->getRepository(Post::class);
        $post = $postRep->findOneBy(['slug' => $slug]);

        if ($post) {
            $numbers = $this->numberOfAnswerOnePost->getNumberOfAnswers($post->getId());
            $likePosts = $postRep->findByPostsLikePost($post->getCategory()->getId(), $post->getId());

            if ($this->getUser()) {
                $addAnswer = new Answer();
                $form = $this->createForm(AnswerPostFormType::class, $addAnswer);
                $form->handleRequest($request);

                if ($this->answer->addAnswerPost($form, $addAnswer, $this->getUser(), $post)) {

                    $this->addFlash('success_add_answer', 'Poprawnie dodano odpowiedź');
                    $this->redirectToRoute('view_post');
                }
                $this->addFlash('error_add_answer', 'Wystąpił bład przy dodawaniu odpowiedzi');

                $answer = $em->getRepository(Answer::class)->findBy(['post' => $post->getId()]);

                if ($answer) {
                    $addComment = new CommentAnswer();
                    $commentForm = $this->createForm(CommentAnswerFormType::class, $addComment);
                    $commentForm->handleRequest($request);

                    foreach ($answer as $item) {
                        if ($this->commentAnswer->addCommentForAnswer($commentForm, $this->getUser(), $item, $addComment)) {
                            $this->addFlash('success_add_comment', 'Poprawnie dodano komentarz');
                        } else {
//                        $this->addFlash('error_add_comment', 'Wystąpił bład przy dodawaniu komentarza');
                        }
                    }

                    return $this->render('post/viewPost/view_post.html.twig', [
                        'post' => $post,
                        'likePost' => $likePosts,
                        'answerForm' => $form->createView(),
                        'numbers' => $numbers,
                        'commentFormForAnswer' => $commentForm->createView(),
                        'catSlug' => $categorySlug
                    ]);
                }

                return $this->render('post/viewPost/view_post.html.twig', [
                    'post' => $post,
                    'likePost' => $likePosts,
                    'answerForm' => $form->createView(),
                    'numbers' => $numbers,
                ]);
            }

            return $this->render('post/viewPost/view_post.html.twig', [
                'post' => $post,
                'numbers' => $numbers,
                'likePost' => $likePosts,
            ]);
        }
        return $this->redirectToRoute('forum');
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
        $post = $em->getRepository(Post::class)->findOneBy(['id' => $postId]);

        if ($this->post->removePost($post)) {
            $this->addFlash('success_remove_post', 'Post został usunięty');
        } else {
            $this->addFlash('error_remove_post', 'Post nie został usunięty');
        }

        return $this->redirectToRoute('profile', ['userId' => $userId, 'userTab' => $userTab]);
    }

    /**
     * @Route("/forum/{categorySlug}/{slug}/usuwanie-odpowiedzi/{answerId}", name="remove_answer")
     * @param int $answerId
     * @param string $categorySlug
     */
    public function removeAnswer(int $answerId, string $categorySlug)
    {
        $em = $this->getDoctrine()->getManager();
        $answer = $em->getRepository(Answer::class)->findOneBy(['id' => $answerId]);

        if ($this->answer->removeAnswer($answer)) {
            $this->addFlash('success_remove_answer', 'Odpowiedź została usunięta');
        } else {
            $this->addFlash('error_remove_answer', 'Odpowiedź nie została usunięta');
        }

        return $this->redirectToRoute('view_post', ['categorySlug' => $categorySlug,'slug' => $answer->getPost()->getSlug()]);
    }
}
