<?php

namespace App\DataFixtures;

use App\Entity\Cepage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CepageFixtures extends Fixture
{
    public const DISPATCH_CEPAGE_VARIETY = ['Merlot','Syrah','Sauvignon','Pinot Noir','Cabernet Franc'];
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<count(self::DISPATCH_CEPAGE_VARIETY); $i++) {
            $cepage = new Cepage();
            $cepage->setVariety(self::DISPATCH_CEPAGE_VARIETY[$i]);
            $manager->persist($cepage);
            $this->addReference('cepage_' . ($i + 1), $cepage);
        }

        $manager->flush();
    }
}
