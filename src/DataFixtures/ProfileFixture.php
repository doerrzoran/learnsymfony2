<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $profile = new Profile();
        $profile->setRs('Facebook');
        $profile->setUrl('https://fr-fr.facebook.com/');

        $profile2 = new Profile();
        $profile2->setRs('twitter');
        $profile2->setUrl('https://twitter.com/?lang=fr');

        $profile3 = new Profile();
        $profile3->setRs('linkedIn');
        $profile3->setUrl('https://fr.linkedin.com/');

        $profile4 = new Profile();
        $profile4->setRs('github');
        $profile4->setUrl('https://github.com/');

        $manager->persist($profile);
        $manager->persist($profile2);
        $manager->persist($profile3);
        $manager->persist($profile4);
        $manager->flush();
    }
}
