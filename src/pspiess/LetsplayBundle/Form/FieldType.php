<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FieldType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fieldnr', 'integer', array('label' => 'Platznummer', 'attr' => array('class' => '')))
                ->add('type', 'choice', array('label' => 'Typ', 'attr' => array('class' => ''),
                    'choices' => array('4er Platz' => '4er Platz', '5er Platz' => '5er Platz'),
                    'preferred_choices' => array('0'), 'required' => true))
                ->add('slots', 'integer', array('label' => 'Teilnehmer', 'attr' => array('class' => '')))
                ->add('ground', 'choice', array('label' => 'Platzbeschaffenheit', 'attr' => array('class' => ''),
                    'choices' => array('Kunstrasen' => 'Kunstrasen', 'Naturrasen' => 'Naturrasen', 'Asche' => 'Asche', 'Halle' => 'Halle'),
                    'preferred_choices' => array('Kunstrasen'), 'required' => false))
                ->add('care', 'date', array('label' => 'letzte Wartung', 'attr' => array('class' => '')))
                ->add('lenght', 'number', array('label' => 'Feldlänge', 'attr' => array('class' => '')))
                ->add('width', 'number', array('label' => 'Feldbreite', 'attr' => array('class' => '')))
                ->add('note', 'textarea', array('label' => 'Bemerkung', 'attr' => array('class' => '')))
                ->add('activation', 'date', array('label' => 'in Betrieb seit', 'attr' => array('class' => '')))
                ->add('prices', null, array('label' => 'Preise', 'attr' => array('class' => '')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Field'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_letsplaybundle_field';
    }

}
