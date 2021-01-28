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
        $username = $form->get('username')->getData();
        $len = strlen($username);
        if($len < 5){
            $this->error = 'Nazwa użytkownika musi zawierać co najmniej 6 znaków';
            return false;
        }
        $user->setUsername($form->get('username')->getData());
        $user->setEmail($form->get('email')->getData());
        $user->setUploadedAt(new \DateTime);

        /** @var UploadedFile $pictureFileName */
        if ($form->get('filename')->getData()) {
            $pictureFileName = $form->get('filename')->getData();
            $newFileName = $this->photoToString->PhotoPostToString($pictureFileName);
            $pictureFileName->move('images/user', $newFileName);
            $user->setFilename($newFileName);
        } else {
            $picture = 'user.png';
            $user->setFilename($picture);
        }
        $plainPassword = $form->get('plainPassword')->getData();
        $secondPassword = $form->get('second_password')->getData();
        
//        \Symfony\Component\VarDumper\VarDumper::dump($plainPassword);
//        \Symfony\Component\VarDumper\VarDumper::dump($secondPassword);
//        \Symfony\Component\VarDumper\VarDumper::dump($form);
//        die('end');
//        die('end');
//        die('end');
        if ($plainPassword === $secondPassword) {

            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $plainPassword
                )
            );
            $user->setSecondPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $secondPassword
                )
            );

            $em = $this->entityManager;
            $em->persist($user);
            $em->flush();

            return true;
        } else {
            $this->error = 'Hasła muszą być takie same';
            return false;
        }
    }

    /**
     * @return mixed
     */
    private $error;

    public function getError()
    {
        return $this->error;
    }
}