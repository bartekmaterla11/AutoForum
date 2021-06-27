<?php

namespace App\Controller\Posts;

use App\Entity\Posts\Answer;
use App\Entity\Posts\CategoryPost;
use App\Entity\Posts\CommentAnswer;
use App\Entity\Posts\Post;
use App\Form\Posts\AnswerPostFormType;
use App\Form\Posts\PostFormType;
use App\Service\Posts\AnswerAddInterface;
use App\Service\Posts\CommentAnswerInterface;
use App\Service\Posts\NumberOfAnswerOnePostInterface;
use App\Service\Posts\PostInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
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
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(PaginatorInterface $paginator, CommentAnswerInterface $commentAnswer, NumberOfAnswerOnePostInterface $numberOfAnswerOnePost, PostInterface $post, AnswerAddInterface $answer)
    {
        $this->numberOfAnswerOnePost = $numberOfAnswerOnePost;
        $this->commentAnswer = $commentAnswer;
        $this->post = $post;
        $this->answer = $answer;
        $this->paginator = $paginator;
    }

    /**
     * @param Request $request
     * @Route("/forum/dodaj-post", name="add_post")
     */
    public function post(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('index');
        }
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->post->addPost($post, $form, $this->getUser())) {
                $this->addFlash('success_post', 'Pytanie zostało dodane poprawnie');

                return $this->redirectToRoute('forum', ['page' => 1]);
            }
            $this->addFlash('error_post', 'Wystąpił błąd. Spróbuj jeszcze raz.');
        }

        return $this->render('post/add/add.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/forum/category/ajax", name="category_change1")
     */
    public function changeCategory1(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = (int)$request->get('option');

        if ($category > 1) {
            $category = $em->getRepository(CategoryPost::class)->find($category);

            return $this->json(['categorySlug' => $category->getSlug()]);
        } else {
            return $this->json(['categorySlug' => ' ']);
        }
    }

    /**
     * @Route("/forum/{page}", name="forum")
     * @param int $page
     * @param Request $request
     */
    public function homepage(int $page)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findByAllPosts();
        $posts = $this->paginator->paginate($posts, $page, 6);
        $categories = $em->getRepository(CategoryPost::class)->findAll();

        return $this->render('post/index/index_post.html.twig', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/forum/1/{categorySlug}", name="forum_sorted")
     */
    public function forum(Request $request, string $categorySlug)
    {
        $page = 1;
        $a = strlen($categorySlug);
        $em = $this->getDoctrine()->getManager();

        if ($request->get('page')) {
            $page = $request->get('page');
        }

        if ($a > 0) {
            $posts = $em->getRepository(Post::class)->findByCategoryPosts($categorySlug);
            $posts = $this->paginator->paginate($posts, $page, 2);
        } else {
            $posts = $em->getRepository(Post::class)->findByAllPosts();
            $posts = $this->paginator->paginate($posts, $page, 6);
        }

        $categories = $em->getRepository(CategoryPost::class)->findAll();

        return $this->render('post/index/index_post.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
            'slug' => $categorySlug
        ]);
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
            $numbers = $this->numberOfAnswerOnePost->getNumberOfAnswers($post);
            $likePosts = $postRep->findByPostsLikePost($post->getCategory()->getId(), $post->getId());

            if ($this->getUser()) {
                $addAnswer = new Answer();
                $form = $this->createForm(AnswerPostFormType::class, $addAnswer);
                $form->handleRequest($request);

                if ($this->answer->addAnswerPost($form, $addAnswer, $this->getUser(), $post)) {

                    $this->addFlash('success_add_answer', 'Poprawnie dodano odpowiedź');
                    return $this->redirectToRoute('view_post', ['categorySlug' => $categorySlug, 'slug' => $slug]);
                }
                $this->addFlash('error_add_answer', 'Wystąpił bład przy dodawaniu odpowiedzi');

                $answerId = (int)$request->get('id');
                if ($answerId) {
                    $answer = $em->getRepository(Answer::class)->findOneBy(['id' => $answerId]);

                    if ($answer) {
                        $addComment = new CommentAnswer();
                        $content = $request->get('con');

                        if ($content) {
                            if ($this->commentAnswer->addCommentForAnswer($content, $this->getUser(), $answer, $addComment)) {
                                return $this->json(['Success' => 'Ok']);
                            } else {
                                $this->addFlash('error_add_comment', 'Wystąpił bład przy dodawaniu komentarza');
                            }
                        }

                        return $this->render('post/view/view_post.html.twig', [
                            'post' => $post,
                            'likePost' => $likePosts,
                            'answerForm' => $form->createView(),
                            'numbers' => $numbers,
                            'catSlug' => $categorySlug
                        ]);
                    }
                }

                return $this->render('post/view/view_post.html.twig', [
                    'post' => $post,
                    'likePost' => $likePosts,
                    'answerForm' => $form->createView(),
                    'numbers' => $numbers,
                    'catSlug' => $categorySlug
                ]);
            }

            return $this->render('post/view/view_post.html.twig', [
                'post' => $post,
                'numbers' => $numbers,
                'likePost' => $likePosts,
                'catSlug' => $categorySlug
            ]);
        }
        return $this->redirectToRoute('forum', ['page' => 1]);
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

        return $this->redirectToRoute('profile', ['page' => 1, 'userId' => $userId, 'userTab' => $userTab]);
    }

    /**
     * @Route("/forum/{categorySlug}/{slug}/usuwanie-odpowiedzi/{answerId}", name="remove_answer")
     * @param int $answerId
     * @param string $slug
     * @param string $categorySlug
     */
    public function removeAnswer(int $answerId, string $slug, string $categorySlug)
    {
        $em = $this->getDoctrine()->getManager();
        $answer = $em->getRepository(Answer::class)->findOneBy(['id' => $answerId]);

        if ($this->answer->removeAnswer($answer)) {
            $this->addFlash('success_remove_answer', 'Odpowiedź została usunięta');
        } else {
            $this->addFlash('error_remove_answer', 'Odpowiedź nie została usunięta');
        }

        return $this->redirectToRoute('view_post', ['categorySlug' => $categorySlug, 'slug' => $slug]);
    }

    /**
     * @Route("/forum/{categorySlug}/{slug}/usuwanie-komentarza/{commentId}", name="remove_comment")
     * @param int $commentId
     * @param string $categorySlug
     */
    public function removeComment(int $commentId, string $categorySlug)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(CommentAnswer::class)->findOneBy(['id' => $commentId]);

        if ($this->commentAnswer->removeComment($comment)) {
            $this->addFlash('success_remove_comment', 'Komentarz został usunięty');
        } else {
            $this->addFlash('error_remove_comment', 'Komentarz nie został usunięty');
        }

        return $this->redirectToRoute('view_post', ['categorySlug' => $categorySlug, 'slug' => $comment->getAnswer()->getPost()->getSlug()]);
    }
}
