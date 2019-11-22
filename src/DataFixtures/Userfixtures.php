<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Userfixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * @var SvgAvatarFactory
     */
    private $svgAvatarFactory;
    /**
     * @var FileSystemHelper
     */
    private $fileSystemHelper;
    private $uploadPath;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * Userfixtures constructor.
     * @param SvgAvatarFactory $svgAvatarFactory
     */
    public function __construct(SvgAvatarFactory $svgAvatarFactory, FileSystemHelper $fileSystemHelper,$uploadPath,UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();
        $this->svgAvatarFactory = $svgAvatarFactory;
        $this->fileSystemHelper = $fileSystemHelper;
        $this->uploadPath = $uploadPath;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $promotions = $this->getReferences('Promotion');

        for($i=0;$i<200;$i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setPassword(password_hash('nounou', PASSWORD_DEFAULT));
            $user->setCity($faker->city);
            $date = rand(1950,2000) . '-' . $faker->month . '-' . $faker->dayOfMonth;
            $user->setBirthdate(new \DateTime($date));


            //$promos = $promotions[rand(0, count($promotions) - 1)];
            $promotion=$faker->randomElements($promotions,rand(1,2));
            //dd($promotion);
            foreach ($promotion as $promo){
                $user->addPromotion($promo);
            }

            $svg = $this->svgAvatarFactory->getAvatar(2, 5);
            $filename = sha1(uniqid(rand(), true)) . '.svg';
            $filepath = $this->uploadPath . '/' . SvgAvatarFactory::AVATAR_DIR . '/' . $filename;
            $this->fileSystemHelper->write($filepath, $svg);
            $user->setAvatar($filename);

            $manager->persist($user);
        }
        $admin= new user();
        $admin->setFirstname('François');
        $admin->setLastname('Grandsire');
        $admin->setEmail('grandsiref@gmail.com');
        $passwordHashed=$this->passwordEncoder->encodePassword($admin,'admin');
        $admin->setPassword($passwordHashed);
        $admin->setCity('Aix-en-Provence');
        $admin->setBirthdate(new \DateTime('1991-07-29'));
        $svg = $this->svgAvatarFactory->getAvatar(2, 5);
        $filename = sha1(uniqid(rand(), true)) . '.svg';
        $filepath = $this->uploadPath . '/' . SvgAvatarFactory::AVATAR_DIR . '/' . $filename;
        $this->fileSystemHelper->write($filepath, $svg);
        $admin->setAvatar($filename);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
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
            YearFixtures::class,
            PromotionFixtures::class
        ];
    }
}
