<?php

namespace App\DataFixtures;


use App\Entity\Promotion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $degrees=$this->getReferences('Degree');
        $years=$this->getReferences('Year');
        $i=0;
        foreach ($degrees as $degree){
            foreach ($years as $year){
                $promo=new Promotion();
                $promo->setDegree($degree);
                $promo->setYear($year);
                $this->addReference('Promotion_'.$i,$promo);
                $manager->persist($promo);
                $i++;
                $dateStart = rand(1950,2000) . '-' . $faker->month . '-' . $faker->dayOfMonth;
                $dateEnd = rand(1950,2000) . '-' . $faker->month . '-' . $faker->dayOfMonth;
                $promo->setStartDate(new \DateTime($dateStart));
                $promo->setEndDate(new\DateTime($dateEnd));
                $promo->setNotes($faker->text);
            }
        }



        $manager->flush();
    }


    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return[
            DegreeFixtures::class,
            YearFixtures::class
        ];
    }
}
