<?php

namespace App\DataFixtures;

use App\Entity\Boutique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BoutiqueFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $boutique =new Boutique();
        $faker = Factory::create('fr_FR');
        for($i = 0 ;$i<30;$i++)
        {
            $boutique= new Boutique();
            $boutique
                ->setNomBoutique($faker->words(3,true))
                ->setDescription($faker->sentences(4,true) )
                ->setNom($faker->words(2,true))
                ->setPrenom($faker->words(2,true))
                ->setAdresse($faker->address)
                ->setVille($faker->city)
                ->setEmail($faker->email)
                ->setPassword('papa5877a')
                ->setCreatedAt(new\ DateTime())
                ->setNumeroCompte($faker->bankAccountNumber)
                ->setActive(true);

            $manager->persist($boutique);

        }
        $manager->flush();
    }
}
