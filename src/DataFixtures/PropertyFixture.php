<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ;$i<100;$i++)
        {
            $property= new Property();
             $property
                 ->setTitle($faker->words(3,true))
                 ->setDescription($faker->sentences(3,true) )

            ->setSurface($faker->numberBetween(20,400))
            ->setRooms($faker->numberBetween(3,30))
                 ->setBetrooms($faker->numberBetween(1,23))
                 ->setFloor($faker->numberBetween(1,23))
            ->setPrice($faker->numberBetween(3000000,50000000))
            ->setChauffage($faker->numberBetween(0,2))
            ->setCity($faker->city)
            ->setAdresse($faker->address)
            ->setPostal($faker->numberBetween(29000,32000))
            ->setSolde(false);
             $manager->persist($property);

        }
        $manager->flush();
    }
}
