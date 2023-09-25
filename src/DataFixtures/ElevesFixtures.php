<?php

namespace App\DataFixtures;

use App\Entity\Eleves;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ElevesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $educateur = $this->getReference('1');

        $eleve = new Eleves;
        $eleve->setNom('Michel');
        $eleve->setPrenom('Jean');
        $eleve->setEducateursId($educateur);
        $manager->persist($eleve);

        $eleve2 = new Eleves;
        $eleve2->setNom('Michel');
        $eleve2->setPrenom('Jean');
        $eleve2->setEducateursId($educateur);
        $manager->persist($eleve2);

        $manager->flush();
    }
}
