<?php

declare(strict_types=1);

namespace App\Service;

use App\Query\ProfileQuery;
use App\Repository\AnswerRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;

class ProfileService implements ProfileInterface
{
    /**
     * @var ProfileQuery
     */
    private $profileQuery;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var AnswerRepository
     */
    private $answerRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ProfileQuery $profileQuery, UserRepository $userRepository, PostRepository $postRepository, AnswerRepository $answerRepository)
    {
        $this->profileQuery = $profileQuery;
        $this->postRepository = $postRepository;
        $this->answerRepository = $answerRepository;
        $this->userRepository = $userRepository;
    }



    public function answeredUserPost($user): array
    {
        $posts = $this->profileQuery->queryForAnsweredUserPosts($user);

        return $this->postRepository->findByUserPosts($posts);
    }

    public function commentedUserAnswer($user): array
    {
        $answers = $this->profileQuery->queryForCommentedUserAnswer($user);

        return $this->answerRepository->findByUserComments($answers);
    }

    public function editProfile(FormInterface $form, $user1, $photo): bool
    {
        if($form->isValid()) {
            try{
                 $this->profileQuery->editProfile($form, $user1, $photo);
                 return true;
            }catch (\Exception $exception){
                return false;
            }
        }
        return false;
    }

    public function editPassword(FormInterface $form, $user, $pass): bool
    {
        if($form->isValid()){

            if($this->profileQuery->editPassword($form, $user, $pass)){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
}
