<?php

namespace App\DataFixtures;

use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RegionFixtures extends Fixture
{
    public const DISPATCH_REGION_NAME = ['Bordeaux','Bourgogne','Touraine', 'Alsace', 'Côtes du Rhône'];
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<count(self::DISPATCH_REGION_NAME); $i++) {
            $region = new Region();
            $region->setName(self::DISPATCH_REGION_NAME[$i]);
            $manager->persist($region);
            $this->addReference('region_' . ($i + 1), $region);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
