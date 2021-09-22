<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PostFixtures extends Fixture
{
    protected $faker;

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
        $this->faker = Factory::create();

        for ($i = 0; $i < 10; $i++)
        {
            $user = new User();
            $user->setEmail($this->faker->email);
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                $this->faker->password
            ));
            $manager->persist($user);

            $profile = new Profile();
            $profile->setFirstname($this->faker->firstName);
            $profile->setLastname($this->faker->lastName);
            $profile->setSex($this->faker->word);
            $profile->setBirthday($this->faker->dateTime);
            $profile->setLocation($this->faker->country);
            $profile->setPhone($this->faker->phoneNumber);
            $profile->setUser($user);
            $manager->persist($profile);

            for($j = 0; $j < 10; $j++)
            {
                $post = new Post();
                $post->setTitle($this->faker->word);
                $post->setDescription($this->faker->realText(100));
                $post->setSlug($this->faker->title . $i . $j);
                $post->setActive($this->faker->boolean());
                $post->setImage($this->faker->imageUrl());
                $post->setUser($user);
                $manager->persist($post);

                for ($k = 0; $k < 10; $k++)
                {
                    $comment = new Comment();
                    $comment->setAuthor($user);
                    $comment->setComment($this->faker->realText(30));
                    $comment->setPost($post);
                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }
}
