<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('rami.aouinti@gmail.com');
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'password'
        ));
        $manager->persist($user);
        $profile = new Profile();
        $profile->setFirstname('Mohamed Rami');
        $profile->setLastname('Aouinti');
        $profile->setSex('Man');
        $profile->setBirthday(new \DateTime('now'));
        $profile->setLocation('Germany');
        $profile->setPhone('12189789782');
        $profile->setUser($user);
        $manager->persist($profile);

        $manager->flush();
    }
}
