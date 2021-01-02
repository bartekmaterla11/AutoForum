<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditDataUserForm;
use App\Form\EditPasswordUserForm;
use App\Query\ProfileQuery;
use App\Service\ProfileInterface;
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


    public function __construct(ProfileInterface $profile, ProfileQuery $profileQuery)
    {
        $this->profile = $profile;
        $this->profileQuery = $profileQuery;
    }

    /**
     * @Route("/uzytkownicy/{userId}/moj-profil/{userTab}", name="profile")
     * @param string $userTab
     * @param int $userId
     */
    public function index(int $userId, string $userTab)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getUsername();
        $users = $em->getRepository(User::class)->findBy(['username'=>$user]);

        $userAnswers = $this->profile->answeredUserPost($userId);
        $userComments = $this->profile->commentedUserAnswer($userId);

        return $this->render('profile/main_profile/main_profile.html.twig',[
            'users'=>$users,
            'user' => $user,
            'userTab'=>$userTab,
            'editProfile' => null,
            'userAnswers'=>$userAnswers,
            'userComments'=>$userComments
        ]);
    }

    /**
     * @Route("/uzytkownicy/{userId}/{username}/{userTab}", name="other_profile")
     * @param string $username
     * @param string $userTab
     * @param int $userId
     */
    public function othersProfiles(int $userId, string $username, string $userTab)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findBy(['username'=>$username]);
        $userAnswers = $this->profile->answeredUserPost($userId);
        $userComments = $this->profile->commentedUserAnswer($userId);

        if($this->getUser()){
            $user = $this->getUser()->getUsername();
            return $this->render('profile/main_profile/main_profile.html.twig',[
                'users'=>$users,
                'user'=>$user,
                'userTab'=>$userTab,
                'userAnswers'=>$userAnswers,
                'userComments'=>$userComments
            ]);
        }
        return $this->render('profile/main_profile/main_profile.html.twig',[
            'users'=>$users,
            'userTab'=>$userTab,
            'userAnswers'=>$userAnswers,
            'userComments'=>$userComments
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
        $user_db = $em->getRepository(User::class);
        $user = $user_db->findBy(['id'=>$userId]);
        $my_user = $user_db->findOneBy(['id'=>$userId]);
        $photo = $my_user->getFilename();

        $form = $this->createForm(EditDataUserForm::class, $my_user);
        $form->handleRequest($request);

        $user1 = new User();
        $form1 = $this->createForm(EditPasswordUserForm::class, $user1);
        $form1->handleRequest($request);
        
        if($this->getUser()) {
            if ($form->isSubmitted()) {
                if ($this->profile->editProfile($form, $my_user, $photo)) {
                    $this->addFlash('success_edit_datas', 'Pomyślnie zaktualizowano dane');
                } else {
                    $this->addFlash('error_edit_data', 'Niestety, nie udało się zaktualizować danych. Spróbuj jeszcze raz');
                }
            }
            if ($form1->isSubmitted()) {
                if ($this->profile->editPassword($form1, $my_user, $this->getUser()->getPassword())) {
                    $this->addFlash('success_edit_pass', 'Pomyślnie zmieniono hasło');
                } else {
                    $this->addFlash('error_edit_pass', $this->profileQuery->getError());
                }
            }
        }

        return $this->render('profile/main_profile/main_profile.html.twig',[
            'users' => $user,
            'userTab' => $userTab,
            'editProfile' => $form->createView(),
            'editPassword' => $form1->createView()
        ]);
    }
}
