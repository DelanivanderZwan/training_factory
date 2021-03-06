<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        $user->setEmail('123@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         'WelcomeNewMember'
                     ));
        $manager->persist($user);
        $user = new User();
        $user->setEmail('456@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'WelcomeNewMember'
        ));
        $user = new User();
        $user->setEmail('789@gmail.com');
        $user->setRoles(['ROLE_INSTRUCTOR']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'WelcomeNewMember'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
