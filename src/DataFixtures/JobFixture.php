<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jobs = [
            "professseur",
            "avocat",
            "charpentier",
            "menuisier",
            "informaticien",
            "cuisinier"
        ];
        for($i = 0; $i<count($jobs); $i++){
            $job = new Job ;
            $job->setDesignation($jobs[$i]);
            $manager->persist($job);
        }
        $manager->flush();
    }
}
