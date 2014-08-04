<?php

namespace pspiess\ContentBundle\DataFixtures\ORM;

use pspiess\ContentBundle\Entity\Project;
use pspiess\ContentBundle\Entity\Pictures;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProjectData implements FixtureInterface {
    public function load (ObjectManager $manager) {
        $this->CreateProject($manager);
    }
    public function CreateProject (ObjectManager $manager) {
        $project = new Project();
        $project->setTitle('Fancy Tuning!');
        $project->setShort('Eine neue Tuning Challenge hat gestartet.');
        $project->setContent('Ein ausführlicher Text wird noch folgen');
        $project->setCategory('Tuning');
        $project->setPicture('cardip.jpg');
        $project->setActive(1);
        
        $project1 = new Project();
        $project1->setTitle('Gasumbau 2014!');
        $project1->setShort('Kleines Projekt');
        $project1->setContent('Eine genau beschreibung kommt noch');
        $project1->setCategory('Gas');
        $project1->setPicture('autogas.jpg');
        $project1->setActive(1);
        
        $project2 = new Project();
        $project2->setTitle('Totalschaden 2013');
        $project2->setShort('Ein Auto was eigentlich verschrottet werden sollte.');
        $project2->setContent('Lorem ipsum habitant odio nisi mi condimentum fringilla ligula, ac curabitur arcu '
                            . 'himenaeos mauris quisque nibh, lorem integer accumsan rhoncus etiam quisque fames lacus sollicitudin '
                            . 'tempus scelerisque ac quam ante.');
        $project2->setCategory('Reparatur');
        $project2->setPicture('schrottauto.jpg');
        $project2->setActive(1);

        $pictures = new Pictures();
        $pictures->setTitle('Bild1');
        $pictures->setPicture('cardip3.jpg');
        
        $pictures1 = new Pictures();
        $pictures1->setTitle('Bild2');
        $pictures1->setPicture('cardip2.jpg');
        
        // relate this picture to the project
        $project1->addPicture($pictures);
        $project1->addPicture($pictures1);
        
        $manager->persist($pictures);
        $manager->persist($pictures1);
        $manager->persist($project);
        $manager->persist($project1);
        $manager->persist($project2);
        

        
        $manager->flush();
    }
}
?>