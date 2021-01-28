<?php

declare(strict_types=1);

namespace App\Query;

use App\Entity\User;
use App\Service\PhotoToString;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileQuery
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var PhotoToString
     */
    private $photoToString;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    private $error;

    public function __construct(Connection $connection, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, PhotoToString $photoToString)
    {

        $this->connection = $connection;
        $this->entityManager = $entityManager;
        $this->photoToString = $photoToString;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function queryForAnsweredUserPosts($userId)
    {
        $sql = 'SELECT DISTINCT post_id FROM answer WHERE user_id = :userId ';
        $users = $this->connection->prepare($sql);
        $users->bindValue(':userId', $userId, ParameterType::INTEGER);
        $users->execute();

        return array_values($users->fetchAll(\PDO::FETCH_COLUMN));
    }

    public function queryForAnsweredPostInt($userId)
    {
        $sql = 'SELECT count(user_id) FROM answer WHERE user_id = :userId ';
        $users = $this->connection->prepare($sql);
        $users->bindValue(':userId', $userId, ParameterType::INTEGER);
        $users->execute();

        return (int) $users->fetchOne();
    }

    public function queryForCommentedUserAnswer($userId)
    {
        $sql = 'SELECT DISTINCT answer_id FROM comment_answer WHERE user_id = :userId ORDER BY answer_id DESC';
        $users = $this->connection->prepare($sql);
        $users->bindValue(':userId', $userId, ParameterType::INTEGER);
        $users->execute();

        return array_values($users->fetchAll(\PDO::FETCH_COLUMN));
    }

    public function queryForCommentedAnswerInt($userId)
    {
        $sql = 'SELECT count(user_id) FROM comment_answer WHERE user_id = :userId ';
        $users = $this->connection->prepare($sql);
        $users->bindValue(':userId', $userId, ParameterType::INTEGER);
        $users->execute();

        return (int) $users->fetchOne();
    }

    public function editProfile(FormInterface $form, $user1, $photo): bool
    {
        try {
            $em = $this->entityManager;
            $user = $em->getRepository(User::class)->find($user1);
            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());

            /** @var UploadedFile $pictureFileName */
            if ($form->get('filename')->getData()) {
                if ($photo != 'user.png') {
                    $file = new Filesystem();
                    $file->remove('images/user/' . $photo);
                }
                $pictureFileName = $form->get('filename')->getData();
                $newFileName = $this->photoToString->PhotoPostToString($pictureFileName);
                $pictureFileName->move('images/user', $newFileName);
                $user->setFilename($newFileName);
            }else{
                $user->setFilename($photo);
            }

            $em->persist($user);
            $em->flush();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function editPassword(FormInterface $form, $user, $passDb): bool
    {
        $em = $this->entityManager;
        $user1 = $em->getRepository(User::class)->find($user);

        $altPass = $form->get('Password')->getData();

        if (password_verify($altPass, $passDb)) {
            if ($form->get('plainPassword')->getData() == $form->get('second_password')->getData()) {

                $user1->setPassword($this->passwordEncoder->encodePassword(
                    $user1,
                    $form->get('plainPassword')->getData()
                ));
                $user1->setSecondPassword($this->passwordEncoder->encodePassword(
                    $user1,
                    $form->get('second_password')->getData()
                ));

                $em->persist($user1);
                $em->flush();

                return true;
            }
            $this->error = 'Nowe i powtórzone nowe hasło nie są zgodne';
            return false;
        }
        $this->error = 'Podałeś błędne aktualne hasło';
        return false;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }
}