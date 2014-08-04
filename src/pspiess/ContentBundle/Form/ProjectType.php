<?php

namespace pspiess\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array('label' => 'Titel', 'attr' => array('class' => 'input-xxlarge')))
                ->add('short', 'text', array('label' => 'Beschreibung', 'attr' => array('class' => 'input-xxlarge')))
                ->add('content', 'text', array('label' => 'Inhalt', 'attr' => array('class' => 'input-xxlarge')))
                ->add('category', 'choice', array('label' => 'Kategorie', 'attr' => array('class' => 'input-xxlarge'), 
                    'choices' => array('Tuning' => 'Tuning', 'Gas' => 'Gas', 'Reparatur' => 'Reparatur'), 'required' => true))
                ->add('active', 'choice', array('label' => 'aktivieren', 'attr' => array('class' => 'input-small'), 
                    'choices' => array('0' => 'Nein', '1' => 'Ja'),
                    'preferred_choices' => array('Nein')))
                ->add('picture', 'file', array('label' => 'Bild', 'required' => false));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\ContentBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_contentbundle_project';
    }

}
