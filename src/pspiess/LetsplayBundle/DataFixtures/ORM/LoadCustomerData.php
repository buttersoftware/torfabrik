<?php

namespace pspiess\LetsplayBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
Use pspiess\LetsplayBundle\Entity\Customer;

class LoadCustomerData implements FixtureInterface {

    public function load(ObjectManager $manager) {

        $customer = new Customer();
        $customer->setTitle('Herr');
        $customer->setPath('');
        $customer->setCustomernr(1);
        $customer->setName('Spieß');
        $customer->setFirstname('Peter');
        $customer->setAddon('Guter Kunde');
        $customer->setStreet('Moritzstraße 9');
        $customer->setZip(47803);
        $customer->setLocation('Krefeld');
        $customer->setCountry('Deutschland');
        $customer->setPhone('0176 - 250 415 785');
        $customer->setMobile('02151 - 714555');
        $customer->setFax('02151 - 714590');
        $customer->setNote('Bitte auf Rabatt achten!');
        $customer->setDiscount(10);
        $customer->setBirthday(new \DateTime("1985-05-11"));
        $customer->setSex('M');
        $customer->setSepa('DE21301204000000015228');
        $customer->setBic('SPKRDE33XXX');
        $customer->setCashing(0);
        $customer->setBank('Sparkasse Krefeld');
        $customer->setBank('Peter Spieß');
        
        $customer1 = new Customer();
        $customer1->setTitle('Herr');
        $customer1->setPath('');
        $customer1->setCustomernr(1);
        $customer1->setName('Azizova');
        $customer1->setFirstname('Kamilla');
        $customer1->setAddon('Guter Kunde');
        $customer1->setStreet('Moritzstraße 9');
        $customer1->setZip(47803);
        $customer1->setLocation('Krefeld');
        $customer1->setCountry('Deutschland');
        $customer1->setPhone('0176 - 250 415 785');
        $customer1->setMobile('02151 - 714555');
        $customer1->setFax('02151 - 714590');
        $customer1->setNote('Bitte auf Rabatt achten!');
        $customer1->setDiscount(20);
        $customer1->setBirthday(new \DateTime("1985-05-11"));
        $customer1->setSex('M');
        $customer1->setSepa('DE21301204000000015228');
        $customer1->setBic('SPKRDE33XXX');
        $customer1->setCashing(0);
        $customer1->setBank('Sparkasse Krefeld');
        $customer1->setBank('Kamilla Azizova');

        $manager->persist($customer);
        $manager->persist($customer1);
        $manager->flush();
    }

}
