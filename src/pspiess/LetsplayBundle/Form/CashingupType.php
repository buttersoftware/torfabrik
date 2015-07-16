<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CashingupType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nominal', 'money', array('label' => 'SOLL BAR', 'attr' => array('class' => '')))
                ->add('actual', 'money', array('label' => 'Ist BAR', 'attr' => array('class' => '')))
                ->add('nominalec', 'money', array('label' => 'SOLL EC', 'attr' => array('class' => '')))
                ->add('actualec', 'money', array('label' => 'Ist EC', 'attr' => array('class' => '')))
                ->add('daydate', 'date', array('label' => 'Tagesdatum'))
                ->add('note', 'textarea', array('label' => 'Bemerkung', 'attr' => array('class' => ''), 'required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Cashingup'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_letsplaybundle_cashingup';
    }

}
