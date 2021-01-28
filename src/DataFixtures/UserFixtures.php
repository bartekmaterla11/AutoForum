<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@wp.pl');
        $user->setRoles(['Role_user']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'bartekcoco11'));
        $user->setSecondPassword($this->passwordEncoder->encodePassword($user, 'bartekcoco11'));
        $manager->persist($user);
        $manager->flush();
    }
}
