<?php

namespace pspiess\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaincategoryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', 'number', array('label' => 'Nummer', 'required' => True))
            ->add('description', 'text', array('label' => 'Bezeichnung', 'required' => True))
            ->add('note', 'textarea', array('label' => 'Beschreibung', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\BlogBundle\Entity\Maincategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pspiess_blogbundle_maincategory';
    }
}
