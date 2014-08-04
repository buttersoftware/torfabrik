<?php

namespace pspiess\ContentBundle\DataFixtures\ORM;

use pspiess\ContentBundle\Entity\slider;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSliderData implements FixtureInterface {
    public function load (ObjectManager $manager) {
        $slider = new slider();   
        $slider->setTitle('Sonderangebot');
        $slider->setContent('Kommen Sie noch heute in vorbei und sichern Sie sich einen Ölwechsel gratis!!!');
        $slider->setLink('www.kicker.de');
        $slider->setLinktext('Tippspiel');
        $slider->setRank(1);
        $slider->setPicture('cardip.jpg');
        $slider->setActive(1);
        
        $slider1 = new slider();   
        $slider1->setTitle('Deine Werkstatt');
        $slider1->setContent('Hier wollen Sie hin!!!');
        $slider1->setLink('www.bild.de');
        $slider1->setLinktext('News');
        $slider1->setRank(2);
        $slider1->setPicture('autogas.JPG');
        $slider1->setActive(1);
        
        $slider2 = new slider();   
        $slider2->setTitle('Gasumbau KOSTENLOS');
        $slider2->setContent('Wir sind die besten!!!');
        $slider2->setLink('www.pspiess.de');
        $slider2->setLinktext('Unser Partner');
        $slider2->setRank(3);
        $slider2->setPicture('autoglas.JPG');
        $slider2->setActive(1);
        
        $manager->persist($slider);
        $manager->persist($slider1);
        $manager->persist($slider2);
        $manager->flush();
    }
}
?>