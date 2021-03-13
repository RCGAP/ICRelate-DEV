<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\PostLike;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;
    private $_user = [];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $user = new User();
        $user->setEmail('user@symfony.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'));

        $manager->persist($user);
        $_user[] = $user;

        for ($i = 0; $i < 20; $i++) {
            $userS = new User();
            $userS->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($userS, 'password'));

            $manager->persist($userS);
            $_user[] = $userS;
        }

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(6))
                ->setIntroduction($faker->paragraph())
                ->setContent('<p>' . join(',', $faker->paragraphs()) . '</p>');

            $manager->persist($post);
            for ($j = 0; $j < mt_rand(0, 10); $j++) {
                $like = new PostLike();
                $like->setPost($post)
                     ->setUser($faker->randomElement($_user));
                $manager->persist($like);     
            }
        }

        $manager->flush();
    }
}
