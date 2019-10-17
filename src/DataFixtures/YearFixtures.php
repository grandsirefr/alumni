<?php

namespace App\DataFixtures;


use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class YearFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=2010;$i<2020;$i++){
            $year = new Year();
            $year->setTitle($i);
            $this->addReference('Year_'.$i,$year);
            $manager->persist($year);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
