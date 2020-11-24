<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Form\CommetPostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentPostController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/komentarz", name="add_comment")
     */
    public function addComment(Request $request)
    {
        if($this->getUser())
        {
            $comment = new Comment();
            $form = $this->createForm(CommetPostFormType::class);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if( $form->isSubmitted() &&  $form->isValid()) {
                try {
                    $comment->setUser($this->getUser());
                    $comment->setContent($form->get('content')->getData());
                    $comment->setUploadedAt(new \DateTime());
                    $pictureFileName = $form->get('filename')->getData();
                    $originalfileName = pathinfo($pictureFileName->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
                        $originalfileName);
                    $newFileName = $safeFileName . '-' . uniqid() . '.' . $pictureFileName->guessExtension();
                    $pictureFileName->move('images/post/comment', $newFileName);
                    $comment->setFilename($newFileName);

                }catch (\Exception $exception){
                    $this->addFlash('error2','Wystąpił bład przy dodawaniu komentarza');
                }
            }

            return $this->render('comment/comment_post.html.twig',[
                'commentForm'=>$form->createView()
            ]);
        }
    }

}