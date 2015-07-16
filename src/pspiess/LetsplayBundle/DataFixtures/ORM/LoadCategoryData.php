<?php

namespace pspiess\LetsplayBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
Use pspiess\BlogBundle\Entity\Maincategory;
Use pspiess\BlogBundle\Entity\Subcategory;
Use pspiess\BlogBundle\Entity\Blog;

class LoadCategoryData implements FixtureInterface {

    public function load(ObjectManager $manager) {

        $entMaincategory = new Maincategory();
        $entMaincategory->setNumber(172);
        $entMaincategory->setDescription('Portale / Verzeichnisse');
        $entMaincategory->setNote('Test Datensatz');
        
        $entSubcategory = new Subcategory();
        $entSubcategory->setNumber(1);
        $entSubcategory->setDescription('Appartements / Stundenzimmer / Studios (mietbar)');
        $entSubcategory->setNote('Test Datensatz');
        $entSubcategory->setMaincategory($entMaincategory);
        
        //Bizarr Ladies
        $entBlog = new Blog();
        $entBlog->setBlogname('Bizarr Ladies');
        $entBlog->setCountry('Deutschland');
        $entBlog->setLocation('Krefeld');
        $entBlog->setNote('');
        $entBlog->setPicture('');
        $entBlog->setState('NRW');
        $entBlog->setStreet('Moritzstraße');
        $entBlog->setWebsite('http://www.bizarrladies.de/');
        $entBlog->setZip('47804');
        $entBlog->setDate(new \Datetime('now'));
        $entBlog->setMaincategory($entMaincategory);
        $entBlog->setSubcategory($entSubcategory);
        
        //Devote Ladies
        $entBlog2 = new Blog();
        $entBlog2->setBlogname('Devote Ladies');
        $entBlog2->setCountry('Deutschland');
        $entBlog2->setLocation('Krefeld');
        $entBlog2->setNote('');
        $entBlog2->setPicture('');
        $entBlog2->setState('NRW');
        $entBlog2->setStreet('Moritzstraße');
        $entBlog2->setWebsite('http://www.devoteladies.de/');
        $entBlog2->setZip('47804');
        $entBlog2->setDate(new \Datetime('now'));
        $entBlog2->setMaincategory($entMaincategory);
        $entBlog2->setSubcategory($entSubcategory);
        
        //Domina Forum
        $entBlog3 = new Blog();
        $entBlog3->setBlogname('Domina Forum');
        $entBlog3->setCountry('Deutschland');
        $entBlog3->setLocation('Krefeld');
        $entBlog3->setNote('');
        $entBlog3->setPicture('');
        $entBlog3->setState('NRW');
        $entBlog3->setStreet('Moritzstraße');
        $entBlog3->setWebsite('http://www.dominaforum.net/');
        $entBlog3->setZip('47804');
        $entBlog3->setDate(new \Datetime('now'));
        $entBlog3->setMaincategory($entMaincategory);
        $entBlog3->setSubcategory($entSubcategory);
        
        //Domina.ws
        $entBlog4 = new Blog();
        $entBlog4->setBlogname('Domina.ws');
        $entBlog4->setCountry('Deutschland');
        $entBlog4->setLocation('Krefeld');
        $entBlog4->setNote('');
        $entBlog4->setPicture('');
        $entBlog4->setState('NRW');
        $entBlog4->setStreet('Moritzstraße');
        $entBlog4->setWebsite('http://my.domina.ws/');
        $entBlog4->setZip('47804');
        $entBlog4->setDate(new \Datetime('now'));
        $entBlog4->setMaincategory($entMaincategory);
        $entBlog4->setSubcategory($entSubcategory);
        
        $manager->persist($entMaincategory);
        $manager->persist($entSubcategory);
        $manager->persist($entBlog);
        $manager->persist($entBlog2);
        $manager->persist($entBlog3);
        $manager->persist($entBlog4);
        $manager->flush();
    }

}
