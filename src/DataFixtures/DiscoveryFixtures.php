<?php

namespace App\DataFixtures;

use App\Entity\Discovery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class DiscoveryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker::create();

	    for($i = 0; $i < 50; $i++) {
		    $discovery = new Discovery();
		    $discovery->setName( $faker->sentence(3) );
		    $discovery->setDescription( $faker->text(200) );
		    $discovery->setImage('default.jpg');
		    $discovery->setSlug( $faker->text(20));

		    $randomCountry = random_int(0, 4);
		    $country = $this->getReference("country$randomCountry");

		    $discovery->setCountry($country);

		    $manager->persist($discovery);
	    }

        $manager->flush();
    }
}
