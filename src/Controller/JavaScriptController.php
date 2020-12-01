<?php


namespace App\Controller;


use App\Entity\Post;
use App\Service\PostMarkInterface;
use App\Service\PostMarkService;
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
        $this->postMarkService->addMarkForPost((int)$request->get('mark'));

        return $this->json(['message' => 'OK']);
    }
}