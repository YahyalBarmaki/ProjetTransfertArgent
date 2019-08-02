<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {    
         $user =new User();   
         $user->setUsername('yahya@gmail.com');
         $user->setRoles(['ROLE_SUPER_ADMIN']);
         $password = $this->encoder->encodePassword($user, 'pass123');
         $user->setPassword($password);
         $user->setNom('LY');
         $user->setPrenom('Yaya');
         $user->setTel('771236655');
         $manager->persist($user);
         $manager->flush();
    }
}
