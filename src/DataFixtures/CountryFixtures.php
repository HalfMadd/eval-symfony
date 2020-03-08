<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Discovery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker::create();
	    for($i = 0; $i < 5; $i++) {
		    $country = new Country();
			$country->setName( $faker->unique()->word );

		    $this->addReference("country$i", $country);

		    $manager->persist($country);
	    }

        $manager->flush();
    }
}
