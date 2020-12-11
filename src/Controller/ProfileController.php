<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profil/", name="profile")
     */
    public function index()
    {
        return $this->render('profile/main_profile/main_profile.html.twig');
    }
}