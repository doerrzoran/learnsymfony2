<?php

namespace App\DataFixtures;

use App\Entity\Hobbie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HobbieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $hobbies = [
            "patisserie",
            "couture",
            "tennis",
            "cyclisme",
            "gaming",
            "parapente"
        ];
        for($i = 0; $i<count($hobbies); $i++){
            $hobbie = new Hobbie ;
            $hobbie->setDesignation($hobbies[$i]);
            $manager->persist($hobbie);
        }
        $manager->flush();
    }
}
