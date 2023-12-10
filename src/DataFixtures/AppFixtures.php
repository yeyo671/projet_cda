<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Category;
use App\Entity\Paint;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void {
        // Utilisation de Faker pour générer des données fictives
        $faker = Factory::create('fr_FR');

        // Création d'un utilisateur de test
        $user = new User();
        $user->setEmail('user@test.com');
        $user->setFirstname('Aurélien');
        $user->setName('Delacroix');
        $user->setPhoneNumber($faker->phoneNumber());
        $user->setAbout($faker->text());
        $user->setInstagram('instagram');
        $user->setRoles(['ROLE_PEINTRE']);
        $password = $this->encoder->hashPassword($user, 'password');
        $user->setPassword($password);
        $manager->persist($user);

        // Création de 10 Blogposts
        for ($i = 0; $i < 10; $i++) {
            $blogpost = new Blogpost();
            $blogpost->setTitle($faker->words(3, true));
            $blogpost->setDate($faker->dateTimeBetween('-6 months', 'now'));
            $blogpost->setContent($faker->text(500));
            $blogpost->setSlug($faker->slug());
            $blogpost->setUser($user);
            $manager->persist($blogpost);
        }

        // Création de 5 Catégories
        $categories = [];
        for ($k = 0; $k < 5; $k++) {
            $category = new Category();
            $category->setName($faker->word());
            $category->setDescription($faker->words(10, true));
            $category->setSlug($faker->slug());
            $manager->persist($category);
            $categories[] = $category;
        }

        // Création de 10 Peintures (2 pour chaque catégorie)
        foreach ($categories as $category) {
            for ($j = 0; $j < 2; $j++) {
                $paint = new Paint();
                $paint->setName($faker->words(3, true));
                $paint->setWidth($faker->randomFloat(2, 20, 60));
                $paint->setHeight($faker->randomFloat(2, 20, 60));
                $paint->setOnSale($faker->randomElement([true, false]));
                $paint->setDateOfCompletion($faker->dateTimeBetween('-6 months', 'now'));
                $paint->setDate($faker->dateTimeBetween('-6 months', 'now'));
                $paint->setDescription($faker->text());
                $paint->setPortfolio($faker->randomElement([true, false]));
                $paint->setSlug($faker->slug());
                $paint->setFile('/peinture.png');
                $paint->addCategory($category);
                $paint->setPrice($faker->randomFloat(2, 100, 9999));
                $paint->setUser($user);
                $manager->persist($paint);
            }
        }
        // Enregistrer toutes les entités créées
        $manager->flush();
    }
}
