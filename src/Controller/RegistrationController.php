<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use App\Service\RegistrationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @var RegistrationInterface
     */
    private $registration;

    public function __construct(RegistrationInterface $registration)
    {
        $this->registration = $registration;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute('index');
        }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($this->registration->registerUser($form, $user)){

                return $guardHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $authenticator,
                    'main' // firewall name in security.yaml
                );
                return $this->redirectToRoute('index');
            }
            $this->addFlash('error_register', 'Hasła muszą się zgadzać !');
            $this->redirectToRoute('app_register');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}


//    /**
//     * @Route("/forum/register/ajax", name="ajax_register")
//     */
//    public function ajaxRegister()
//    {
//        $user = new User();
//        $form = $this->createForm(RegistrationFormType::class, $user);
//
//        return $this->render('components/register_com.html.twig', [
//            'registrationForm' => $form->createView(),
//        ]);
//    }

