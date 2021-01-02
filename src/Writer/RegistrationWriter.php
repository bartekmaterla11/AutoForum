<?php

declare(strict_types=1);

namespace App\Writer;

use App\Entity\User;
use App\Service\PhotoToString;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
    /**
     * @var PhotoToString
     */
    private $photoToString;

    public function __construct(PhotoToString $photoToString, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->photoToString = $photoToString;
    }

    public function addUserToDataBase(FormInterface $form, User $user): bool
    {
        $user->setUsername($form->get('username')->getData());
        $user->setEmail($form->get('email')->getData());

        /** @var UploadedFile $pictureFileName */
        if ($form->get('filename')->getData()) {
            $pictureFileName = $form->get('filename')->getData();
            $newFileName = $this->photoToString->PhotoPostToString($pictureFileName);
            $pictureFileName->move('images/user', $newFileName);
            $user->setFilename($newFileName);
        } else {
            $picture = 'user.jpg';
            $user->setFilename($picture);
        }
        $plainPassword = $form->get('plainPassword')->getData();
        $secondPassword = $form->get('second_password')->getData();

        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $plainPassword
            )
        );
        $user->setSecondPassword($this->passwordEncoder->encodePassword(
            $user,
            $secondPassword
            )
        );

        if ($plainPassword == $secondPassword) {
            $em = $this->entityManager;
            $em->persist($user);
            $em->flush();

            return true;
        } else {
            return false;
        }
    }
}