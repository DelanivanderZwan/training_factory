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
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail('DelanivdZwan@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         'Trooper600'
                     ));
        $manager->persist($user);
        $user = new User();
        $user->setEmail('VitoKloots@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'VitoKloots123'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
