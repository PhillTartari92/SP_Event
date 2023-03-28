<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $adminUser = new User();

        $adminUser->setEmail('admin@gmail.com');
        $adminUser->setPassword(password_hash('123456' , PASSWORD_DEFAULT));
        $adminUser->setNom('Boss');
        $adminUser->setPrenom('Patron');
        $adminUser->setVille('Rio');
        $adminUser->setCodepostal('99150');
        $adminUser->setTelephone('0712345678');
        $adminUser->setAdresse('Rue duCul');
        $adminUser->setCreatedAt(new \DateTime());
        


        $adminUser->setRoles(['ROLE_ADMIN']);


        // $product = new Product();
        $manager->persist($adminUser);

        $manager->flush();
    }
}