<?php

namespace App\Controller;

use App\Service\Posts\PostMarkInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JavaScriptController extends AbstractController
{
    /**
     * @var PostMarkInterface
     */
    private $postMarkService;

    public function __construct(PostMarkInterface $postMarkService)
    {
        $this->postMarkService = $postMarkService;
    }

    /**
     * @Route("/like/ajax", name="like_ajax")
     */
    public function setLikeUpAction(Request $request)
    {
        if($this->postMarkService->addMarkForPost(
            (int)$request->get('mark'), (int)$request->get('postid'), $this->getUser()->getId()
        )){
            return $this->json(['message' => 'OK']);
        }else{
            return $this->json(['Error' => 'true']);
        }
    }

    /**
     * @Route("/like/ajax/answer", name="like_ajax_answer")
     */
    public function setLikeUpAnswerAction(Request $request)
    {
        if($this->postMarkService->addMarkForAnswer(
            (int)$request->get('mark1'),(int)$request->get('answerid'), $this->getUser()->getId()
        )){
            return $this->json(['message' => 'OK']);
        }else{
            return $this->json(['Error' => 'true']);
        }
    }

    /**
     * @Route()
     * @param Request $request
     */
    public function searchPost(Request $request)
    {
        
    }
}
