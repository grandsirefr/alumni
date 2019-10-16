<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $degree=new Degree();
        $degree->setName('Développement web et Web mobile');
        $manager->persist($degree);

        $manager->flush();
    }
}
