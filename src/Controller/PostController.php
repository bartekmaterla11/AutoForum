<?php


namespace App\Controller;


use App\Entity\Post;
use App\Form\PostFormType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/dodaj-post", name="add_post")
     */
    public function Post(Request $request ): Response
    {
        $post= new Post();
        $form=$this->createForm(PostFormType::class,$post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if($this->getUser()) {
                /** @var UploadedFile $pictureFileName */
                $pictureFileName=$form->get('filename')->getData();
                try {
                    $originalfileName = pathinfo($pictureFileName->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
                        $originalfileName);
                    $newFileName = $safeFileName . '-' . uniqid() . '.' . $pictureFileName->guessExtension();
                    $pictureFileName->move('images/post', $newFileName);

                    $post->setUser($this->getUser());
                    $post->setTitle($form->get('title')->getData());
                    $post->setUploadedAt(new\DateTime());
                    $post->setContent($form->get('content')->getData());
                    $post->setFilename($newFileName);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($post);
                    $em->flush();
                    $this->addFlash('success','Pytanie zostało dodane poprawnie');
                    $this->redirectToRoute('index');

                }catch (\Exception $e ){
                    $this->addFlash('error1','Ups, Wystąpił błąd');
                }
            }
        }

        return $this->render('post/addPost/add.html.twig',[
            'postForm'=>$form->createView()
        ]);
    }

    /**
     * @Route("/forum/{title}", name="view_post")
     * @param string $title
     */
    public function viewPost($title)
    {
        $em=$this->getDoctrine()->getManager();
        /**
         * @var $post Post
         */
        $post=$em->getRepository(Post::class)->findBy(['title' => $title]);
        $user=$this->getUser()->getUsername();
        if ($post) {
            return $this->render('post/viewPost/view_post.html.twig',[
                'posts' => $post,
                'user' => $user,
            ]);
        }

        return $this->redirectToRoute('index');

//        \Symfony\Component\VarDumper\VarDumper::dump($post);
//        die('end');

    }
}