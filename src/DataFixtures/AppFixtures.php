<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Category;
use App\Entity\Paint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager): void
    {
        //  Utilisation de Faker
        $faker = Factory::create('fr_FR');

        //  Création d'un utilisateur

        $user = new User();
        $user->setEmail('user@test.com');
        $user->setFirstname($faker->firstName());
        $user->setName($faker->name());
        $user->setPhoneNumber($faker->phoneNumber());
        $user->setAbout($faker->text());
        $user->setInstagram('instagram');

        $password = $this->encoder->hashPassword($user, 'password');
        $user->setPassword($password);
        $manager->persist($user);

        //Création de 10 Blogpost
        for($i=0; $i<10; $i++){
            $blogpost = new Blogpost();

            $blogpost->setTitle($faker->words(3,true));
            $blogpost->setDate($faker->dateTimeBetween('-6 month', 'now'));
            $blogpost->setContent($faker->text(500));
            $blogpost->setSlug($faker->slug(3));
            $blogpost->setUser($user);

            $manager->persist($blogpost);
        }

        //Création de 5 Catégories
        for($k=0;$k<5;$k++){
            $category = new Category();

            $category->setName($faker->word());
            $category->setDescription($faker->words(10,true));
            $category->setSlug($faker->slug());

            $manager->persist($category);
        }

        //Création de 10 Peintures/Catégories
        for($j=0; $j<10; $j++){
            $paint = new Paint();
            
            $paint->setName($faker->words(3,true));
            $paint->setWidth($faker->randomFloat(2,20,60));
            $paint->setHeight($faker->randomFloat(2,20,60));
            $paint->setOnSale($faker->randomElement([true,false]));
            $paint->setDateOfCompletion($faker->dateTimeBetween('-6 month', 'now'));
            $paint->setDate($faker->dateTimeBetween('-6 month', 'now'));
            $paint->setDescription($faker->text());
            $paint->setPortfolio($faker->randomElement([true,false]));
            $paint->setSlug($faker->slug());
            $paint->setFile('/img/peinture.png');
            $paint->addCategory($category);
            $paint->setPrice($faker->randomFloat(2,100,9999));
            $paint->setUser($user);

            $manager->persist($paint);
        }

        $manager->flush();
    }
}
