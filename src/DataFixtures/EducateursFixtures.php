<?php

namespace App\DataFixtures;

use App\Entity\Educateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EducateursFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder) {}

    public function load(ObjectManager $manager): void
    {
        $educateur = new Educateurs;
        $educateur->setEmail('email@test.fr');
        $educateur->setPassword(
            $this->passwordEncoder->hashPassword($educateur, 'azerty')
        );
        $educateur->setNom('Nom');
        $educateur->setPrenom('Prénom');
        $educateur->setRgpd('1');
        $manager->persist($educateur);

        $this->addReference('1', $educateur);

        $manager->flush();
    }
}
