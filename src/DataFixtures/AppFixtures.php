<?php

namespace App\DataFixtures;

use App\Entity\Option;
use App\Entity\Subscription;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');
        $option1 = new Option();
        $option1->setName("Soir et WE")->setPrice($faker->randomNumber(2));
        $option2 = new Option();
        $option2->setName("Coaching")->setPrice($faker->randomNumber(2));
        $option3 = new Option();
        $option3->setName("Cours Collectif")->setPrice($faker->randomNumber(2));
        $tabOption = [$option1,$option2,$option3];
        $manager->persist($option1);
        $manager->persist($option2);
        $manager->persist($option3);
        $tabSub = [];
        for ($i = 0; $i <= 30; $i++) {
            $Subscription = new Subscription();
            $Subscription
                ->setDate($faker->dateTime)
                ->setMembercard($faker->creditCardNumber);
            for ($u = 0; $u <$faker->numberBetween(0,sizeof($tabOption)); $u++){

                $Subscription->addOption($tabOption[$u]);
            }
            $tabSub [] = $Subscription;
            $manager->persist($Subscription);
        }
        for ($i = 0; $i <= 30; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setForname($faker->firstName())
                ->setName($faker->lastName)
                ->setPassword($faker->password)
                ->setSub($tabSub[$i])
            ;
            $manager->persist($user);
        }
        $manager->flush();
    }





}
