<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $pwdEncode)
    {
        $this->passwordEncoder = $pwdEncode;
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail("tot@toto.fr");
        $hashPwd = $this->passwordEncoder->encodePassword($user, "toto");
        $user->setPassword($hashPwd);

        //TO ENCODE PASSWORDS SEE WEBSITE: https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers

        

        $manager->persist($user);

        $manager->flush();
    }
}
