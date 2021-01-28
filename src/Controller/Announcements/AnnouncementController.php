<?php

namespace App\Controller\Announcements;

use App\Entity\MainCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @Route("/ogloszenia", name="announcement")
     */
    public function homepage()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(MainCategory::class)->findAll();

        return $this->render('announcement/index/index_announcements.html.twig',[
            'cat' => $categories
        ]);
    }

    /**
     * @Route("/ogloszenia/{categorySlug}", name="announcement_sorted")
     * @param string $categorySlug
     */
    public function announcements(string $categorySlug)
    {

    }
}
