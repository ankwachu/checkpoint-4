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
        // Création d’un utilisateur de type “auteur”
        $subscriber = new User();
        $subscriber->setEmail('subscriber@monsite.com');
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setFirstname('John');
        $subscriber->setLastname('lennon');
        $subscriber->setBiography('lennon');
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            'subscriberpassword'
        ));

        $manager->persist($subscriber);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('Paul');
        $admin->setLastname('Paul');
        $admin->setBiography('Paul');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();

    }
}