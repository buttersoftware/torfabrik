<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceposType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pos')
            ->add('product')
            ->add('description')
            ->add('discount')
            ->add('quantity')
            ->add('price')
            ->add('totalPrice')
            ->add('tax')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Invoicepos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pspiess_letsplaybundle_invoicepos';
    }
}
