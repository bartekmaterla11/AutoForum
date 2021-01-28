<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @Route("/ogloszenia", name="announcement")
     */
    public function index()
    {

        return $this->render('announcement/index/index_announcements.html.twig');
    }
}
