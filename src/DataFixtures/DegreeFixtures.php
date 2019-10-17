<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ex=['Développement Web et Web Mobile','Webdesign','Développeur JAVA J2EE','Électricien', 'Secrétaire Médical'];
        for($i=0;$i<count($ex);$i++) {
            $degree = new Degree();
            $degree->setName($ex[$i]);
            $this->addReference('Degree_'.$i,$degree);
            $manager->persist($degree);
        }
        $manager->flush();
    }
}
