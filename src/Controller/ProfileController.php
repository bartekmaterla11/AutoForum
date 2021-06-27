<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Posts\Post;
use App\Entity\User;
use App\Form\EditDataUserForm;
use App\Form\EditPasswordUserForm;
use App\Query\ProfileQuery;
use App\Repository\OfferRepository;
use App\Repository\Posts\PostRepository;
use App\Service\ProfileInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @var ProfileInterface
     */
    private $profile;
    /**
     * @var ProfileQuery
     */
    private $profileQuery;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var OfferRepository
     */
    private $offerRepository;
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;


    public function __construct(PaginatorInterface $paginator, ProfileInterface $profile, ProfileQuery $profileQuery, PostRepository $postRepository, OfferRepository $offerRepository)
    {
        $this->profile = $profile;
        $this->profileQuery = $profileQuery;
        $this->postRepository = $postRepository;
        $this->offerRepository = $offerRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/uzytkownicy/{userId}/{page}/moj-profil/{userTab}", name="profile")
     * @param string $userTab
     * @param int $userId
     * @param int $page
     */
    public function index(int $userId, string $userTab, int $page)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getUsername();
        $users = $em->getRepository(User::class)->findBy(['username' => $user]);

        $postsUser = $this->postRepository->findByAllPostsUser($userId);
        $userAnswers = $this->profile->answeredUserPost($userId);
        $userComments = $this->profile->commentedUserAnswer($userId);
        $intAnswers = $this->profile->answeredIntUserPost($userId);
        $intComments = $this->profile->commentedIntUserAnswer($userId);
        $offersUser = $this->offerRepository->findByAllOffersUser($userId);
        $postsUser = $this->paginator->paginate($postsUser, $page, 3);
        $offersUser = $this->paginator->paginate($offersUser, $page, 3);
        $userAnswers = $this->paginator->paginate($userAnswers, $page, 3);
        $userComments = $this->paginator->paginate($userComments, $page, 3);
        $likeOffers = $em->getRepository(Offer::class)->findByLikeUserOffers($userId);
        $likePosts = $em->getRepository(Post::class)->findByLikeUserPosts($userId);
        $intLikePosts = count($likePosts);
        $intLikeOffers = count($likeOffers);

        return $this->render('profile/main_profile/main_profile.html.twig', [
            'users' => $users,
            'user' => $user,
            'name' => $user,
            'userTab' => $userTab,
            'editProfile' => null,
            'posts' => $postsUser,
            'offers' => $offersUser,
            'userAnswers' => $userAnswers,
            'userComments' => $userComments,
            'intAnswers' => $intAnswers,
            'intComments' => $intComments,
            'likePosts' => $likePosts,
            'likeOffers' => $likeOffers,
            'intLikePosts' => $intLikePosts,
            'intLikeOffers' => $intLikeOffers,
        ]);
    }

    /**
     * @Route("/uzytkownicy/{userId}/moj-profil/{userTab}/zmiana-danych", name="edit_profile")
     * @param string $userTab
     * @param int $userId
     */
    public function editProfile(Request $request, string $userTab, int $userId)
    {
        $em = $this->getDoctrine()->getManager();
        $userDb = $em->getRepository(User::class);
        $user = $userDb->findBy(['id' => $userId]);
        $myUser = $userDb->findOneBy(['id' => $userId]);
        $photo = $myUser->getFilename();

        $form = $this->createForm(EditDataUserForm::class, $myUser);
        $form->handleRequest($request);

        $user1 = new User();
        $form1 = $this->createForm(EditPasswordUserForm::class, $user1);
        $form1->handleRequest($request);

        if ($this->getUser()) {
            if ($form->isSubmitted()) {
                if ($this->profile->editProfile($form, $myUser, $photo)) {
                    $this->addFlash('success_edit_datas', 'Pomyślnie zaktualizowano dane');
                } else {
                    $this->addFlash('error_edit_data', 'Niestety, nie udało się zaktualizować danych. Spróbuj jeszcze raz');
                }
            }
            if ($form1->isSubmitted()) {
                if ($this->profile->editPassword($form1, $myUser, $this->getUser()->getPassword())) {
                    $this->addFlash('success_edit_pass', 'Pomyślnie zmieniono hasło');
                } else {
                    $this->addFlash('error_edit_pass', $this->profileQuery->getError());
                }
            }
        }

        return $this->render('profile/main_profile/main_profile.html.twig', [
            'users' => $user,
            'name' => $this->getUser()->getUsername(),
            'userTab' => $userTab,
            'editProfile' => $form->createView(),
            'editPassword' => $form1->createView()
        ]);
    }

    /**
     * @Route("/uzytkownicy/{userId}/{page}/{username}/{userTab}", name="other_profile")
     * @param string $username
     * @param string $userTab
     * @param int $userId
     * @param int $page
     */
    public function othersProfiles(int $userId, string $username, string $userTab, int $page)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findBy(['username' => $username]);

        $posts = $this->postRepository->findByAllPostsUser($userId);
        $userAnswers = $this->profile->answeredUserPost($userId);
        $userComments = $this->profile->commentedUserAnswer($userId);
        $intAnswers = $this->profile->answeredIntUserPost($userId);
        $intComments = $this->profile->commentedIntUserAnswer($userId);
        $offers = $this->offerRepository->findByAllOffersUser($userId);
        $posts = $this->paginator->paginate($posts, $page, 3);
        $offers = $this->paginator->paginate($offers, $page, 3);
        $userAnswers = $this->paginator->paginate($userAnswers, $page, 3);
        $userComments = $this->paginator->paginate($userComments, $page, 3);
        $likeOffers = $em->getRepository(Offer::class)->findByLikeUserOffers($userId);
        $likePosts = $em->getRepository(Post::class)->findByLikeUserPosts($userId);
        $intLikePosts = count($likePosts);
        $intLikeOffers = count($likeOffers);

        if ($this->getUser()) {
            $user = $this->getUser()->getUsername();

            return $this->render('profile/main_profile/main_profile.html.twig', [
                'users' => $users,
                'user' => $user,
                'name' => $username,
                'userTab' => $userTab,
                'editProfile' => null,
                'posts' => $posts,
                'offers' => $offers,
                'userAnswers' => $userAnswers,
                'userComments' => $userComments,
                'intAnswers' => $intAnswers,
                'intComments' => $intComments,
                'intLikePosts' => $intLikePosts,
                'intLikeOffers' => $intLikeOffers,
            ]);
        } else {

            return $this->render('profile/main_profile/main_profile.html.twig', [
                'users' => $users,
                'userTab' => $userTab,
                'posts' => $posts,
                'offers' => $offers,
                'editProfile' => null,
                'userAnswers' => $userAnswers,
                'userComments' => $userComments,
                'intAnswers' => $intAnswers,
                'intComments' => $intComments,
                'name' => $username,
                'intLikePosts' => $intLikePosts,
                'intLikeOffers' => $intLikeOffers,
            ]);
        }
    }
}
