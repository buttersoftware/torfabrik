<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PriceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('indentifier', 'text', array('label' => 'Bezeichnung', 'attr' => array('class' => '')))
                ->add('price', 'money', array('label' => 'Stundenpreis', 'attr' => array('class' => '')))
                ->add('weekdayfrom', 'choice', array('label' => 'Wochentag von/bis', 'attr' => array('class' => ''),
                    'choices' => array('0' => 'Montag', '1' => 'Dienstag', '2' => 'Mittwoch', '3' => 'Donnerstag', '4' => 'Freitag', '5' => 'Samstag', '6' => 'Sonntag'),
                    'preferred_choices' => array('0'), 'required' => true))
                ->add('weekdayto', 'choice', array('label' => 'Wochentag bis', 'attr' => array('class' => 'input-medium'),
                    'choices' => array('0' => 'Montag', '1' => 'Dienstag', '2' => 'Mittwoch', '3' => 'Donnerstag', '4' => 'Freitag', '5' => 'Samstag', '6' => 'Sonntag'),
                    'preferred_choices' => array('6'), 'required' => true))
                ->add('timefrom', 'time', array('label' => 'Uhrzeit von', 'attr' => array('class' => '')))
                ->add('timeto', 'time', array('label' => 'Uhrzeit bis', 'attr' => array('class' => '')))
                ->add('note', 'textarea', array('label' => 'Bemerkung', 'attr' => array('class' => '')))
                ->add('fields', null, array('label' => 'Platz', 'required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Price'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_letsplaybundle_price';
    }

}
