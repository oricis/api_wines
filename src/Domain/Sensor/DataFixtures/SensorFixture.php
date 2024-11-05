<?php

namespace App\Domain\Sensor\DataFixtures;

use App\Domain\Sensor\Entity\Sensor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SensorFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // create 10 sensors! Bam!
        for ($i = 0; $i < 10; $i++) {
            $name = 'sensor ' . $i;

            $sensor = new Sensor();
            $sensor->setName($name);

            $manager->persist($sensor);
        }

        $manager->flush();
    }
}
