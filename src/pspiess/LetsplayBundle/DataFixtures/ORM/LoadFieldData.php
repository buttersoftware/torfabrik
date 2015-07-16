<?php

namespace pspiess\LetsplayBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
Use pspiess\LetsplayBundle\Entity\Field;
Use pspiess\LetsplayBundle\Entity\Price;

class LoadFieldData implements FixtureInterface {

    public function load(ObjectManager $manager) {

        $price = new Price();
        $price->setPrice(44.00);
        $price->setWeekdayfrom(0);
        $price->setWeekdayto(6);
        $price->setIndentifier('Mo - Fr Vormittags');
        $price->setTimefrom(new \DateTime("11:00:00"));
        $price->setTimeto(new \DateTime("15:00:00"));
        $price->setNote('Normalpreis - Vormittags');

        $price1 = new Price();
        $price1->setPrice(60.00);
        $price1->setWeekdayfrom(0);
        $price1->setWeekdayto(6);
        $price1->setIndentifier('Mo - Fr Nachmittags');
        $price1->setTimefrom(new \DateTime("15:00:00"));
        $price1->setTimeto(new \DateTime("20:00:00"));
        $price1->setNote('Normalpreis - Nachmittags');

//        $manager->persist($price);
//        $manager->persist($price1);
//
//        $manager->flush();

        $field = new Field();
        $field->setFieldnr(1);
        $field->setType('4er Court');
        $field->setSlots(8);
        $field->setGround('Kunstrasen');
        $field->setCare(new \DateTime("2014-01-01"));
        $field->setLenght(40);
        $field->setWidth(20);
        $field->setNote('Normaler Kunstrasenplatz für 4 vs 4 Spiele');
        $field->setActivation(new \DateTime("2014-01-01"));
        $field->addPrice($price);

        $field1 = new Field();
        $field1->setFieldnr(1);
        $field1->setType('5er Court');
        $field1->setSlots(10);
        $field1->setGround('Kunstrasen');
        $field1->setCare(new \DateTime("2013-01-01"));
        $field1->setLenght(50);
        $field1->setWidth(30);
        $field1->setNote('Normaler Kunstrasenplatz für 5 vs 5 Spiele');
        $field1->setActivation(new \DateTime("2014-01-01"));
        $field1->addPrice($price1);
        
//        $manager->persist($field);
//        $manager->persist($field1);
//        $manager->flush();
    }
}
