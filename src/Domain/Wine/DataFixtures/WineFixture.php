<?php

namespace App\Domain\Wine\DataFixtures;

use App\Domain\Wine\Entity\Wine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WineFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // create 50 wines! Bam!
        for ($i = 0; $i < 50; $i++) {
            $name = 'wine ' . $i;

            $wine = new Wine();
            $wine->setName($name);
            $wine->setYear(rand(1900, date('Y')));

            $manager->persist($wine);
        }

        $manager->flush();
    }
}
