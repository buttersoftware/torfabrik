sgood information about mappings

http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html#many-to-many-bidirectional
--------------------------------------------------
this bundle is for basic content manangement
-----generate:entity: slider ------
title:      string 
content:    text
link:       string
linktext:   string
rank:       smallint
picture:    blob
active:     smallint
created:    datetime
-----------------------------------
-----generate:entity: project -----
title:      string 
short:      text
content:    text
category:   string
picture:    blob
active:     smallint
created:    datetime
-----------------------------------
1
|    ManyToOne  --> console doctrine:generate:entities pspiessContentBundle
n
-----generate:entity: pictures ----
title:      string
picture:    blob
-----------------------------------

----- fixture for slider ----------
class LoadSliderData implements FixtureInterface {
    public function load (EntityManager $manager) {
        $slider = new slider();   
        $slider->setTitle('Sonderangebot');
        $slider->setContent('Kommen Sie noch heute in vorbei und sichern Sie sich einen Ölwechsel gratis!!!');
        $slider->setLink('www.kicker.de');
        $slider->setLinktext('Tippspiel');
        $slider->setRank(1);
        //$slider->setPicture(1);
        $slider->setActive(1);
        $manager->persist($slider);
        $manager->flush();
    }
}
-----------------------------------