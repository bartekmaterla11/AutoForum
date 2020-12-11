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
        return $this->render('index/announcement_index/announcement_index.html.twig');
    }

    /**
     * @Route("/dodaj-ogloszenie", name="add_announcement")
     */
    public function addAnnouncement()
    {
        $announcement = ds;
    }
}