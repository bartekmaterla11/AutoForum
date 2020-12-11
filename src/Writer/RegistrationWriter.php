<?php

declare(strict_types=1);

namespace App\Writer;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationWriter
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function addUserToDataBase(FormInterface $form, User $user): bool
    {
        $user->setUsername($form->get('username')->getData());
        $user->setEmail($form->get('email')->getData());
        // encode the plain password
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            )
        );

        $user->setSecondPassword($this->passwordEncoder->encodePassword(
            $user,
            $form->get('second_password')->getData()
        )
        );

        if ($form->get('second_password')->getData() == $form->get('plainPassword')->getData()) {

            $em = $this->entityManager;
            $em->persist($user);
            $em->flush();

            return true;
        } else {
            return false;
        }
    }
}