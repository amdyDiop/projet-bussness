<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ProduitsFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ;$i<100;$i++)
        {
            $produit= new Produit();
            $produit
                ->setLabelle($faker->words(3,true))
                ->setDescription($faker->sentences(3,true) )
                ->setPoids($faker->numberBetween(2.5,4))
                ->setStock($faker->numberBetween(5,20))
                ->setPrix($faker->numberBetween(1800,3000))
                ->setStockinit($faker->numberBetween(40,200))
                ->setTva($faker->numberBetween(18,18))
                ->setVisible(true)
            ->setCreatedAt(new\ DateTime());
            $manager->persist($produit);

        }
        $manager->flush();
    }
}
