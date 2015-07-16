<?php

namespace pspiess\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('date', 'date', array('years' => range(1950, 2020), 'empty_value' => array('year' => 'Jahr', 'month' => 'Monat', 'day' => 'Tag'),
                    'label' => 'Datum', 'attr' => array('class' => ''), 'required' => True))
                ->add('blogname', 'text', array('label' => 'Name', 'attr' => array('class' => '')))
                ->add('street', 'text', array('label' => 'Straße', 'required' => false))
                ->add('zip', 'integer', array('label' => 'Plz', 'required' => false))
                ->add('location', 'text', array('label' => 'Ort', 'required' => false))
                ->add('state', 'text', array('label' => 'Bundesland', 'required' => false))
                ->add('country', 'text', array('label' => 'Land', 'attr' => array('class' => '')))
                ->add('website', 'url', array('label' => 'Webseite', 'attr' => array('class' => '')))
                ->add('picture', 'file', array('label' => 'Bild', 'required' => false))
                ->add('website', 'url', array('label' => 'Webseite', 'attr' => array('class' => '')))
                ->add('thumbnail', 'url', array('label' => 'Vorschau', 'attr' => array('class' => '')))
                ->add('favicon', 'file', array('label' => 'Favicon', 'required' => false))
                ->add('active', 'choice', array('label' => 'aktiv', 'attr' => array('class' => ''),
                    'choices' => array('1' => 'Ja', '0' => 'Nein'),
                    'preferred_choices' => array('1'), 'required' => True))
                ->add('onstart', 'choice', array('label' => 'immer auf der Startseite anzeigen', 'attr' => array('class' => ''),
                    'choices' => array('1' => 'Ja', '0' => 'Nein'),
                    'preferred_choices' => array('1'), 'required' => True))
                ->add('random', 'choice', array('label' => 'zufällig auf der Startseite anzeigen', 'attr' => array('class' => ''),
                    'choices' => array('1' => 'Ja', '0' => 'Nein'),
                    'preferred_choices' => array('1'), 'required' => True))
                ->add('contact', 'choice', array('label' => 'bereits angeschrieben', 'attr' => array('class' => ''),
                    'choices' => array('1' => 'Ja', '0' => 'Nein'),
                    'preferred_choices' => array('0'), 'required' => True))
                ->add('maincategory', null, array('label' => 'Hauptkategorie', 'attr' => array('class' => '')))
                ->add('subcategory', null, array('label' => 'Unterkategorie', 'attr' => array('class' => '')))
                ->add('note', 'textarea', array('label' => 'Bemerkung', 'required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\BlogBundle\Entity\Blog'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_blogbundle_blog';
    }

}
