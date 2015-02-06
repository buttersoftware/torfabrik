<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CashingupType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nominal', 'money', array('label' => 'SOLL', 'attr' => array('class' => '')))
            ->add('actual', 'money', array('label' => 'Ist', 'attr' => array('class' => '')))
            ->add('daydate', 'date', array('label' => 'Tagesdatum', 'data' => new \DateTime("now")))
            ->add('note', 'textarea', array('label' => 'Bemerkung', 'attr' => array('class' => '')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Cashingup'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pspiess_letsplaybundle_cashingup';
    }
}
