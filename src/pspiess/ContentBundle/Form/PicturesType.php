<?php

namespace pspiess\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PicturesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array('label' => 'Titel', 'attr' => array('class' => 'input-xxlarge')))
                ->add('project', 'entity', array('label' => 'zum Projekt hinzufügen', 'class' => 'pspiessContentBundle:Project'))
                ->add('picture', 'file', array('label' => 'Bild', 'required' => false));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\ContentBundle\Entity\Pictures'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_contentbundle_pictures';
    }

}
