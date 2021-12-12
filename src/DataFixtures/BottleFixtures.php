<?php

namespace App\DataFixtures;

use App\Entity\Bottle;
use App\Entity\Wine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BottleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<count(WineFixtures::PICTURES); $i++) {
            $bottle = new Bottle();
            $bottle->setYear(rand(1980,2018));
            $bottle->setWine($this->getReference('wine_' . ($i + 1)));
            $manager->persist($bottle);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
          WineFixtures::class
        ];
    }
}
