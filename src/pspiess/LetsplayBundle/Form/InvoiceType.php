<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceType extends AbstractType {
    
    protected $booking_id;
    
    public function __construct($id = null) {
        $this->booking_id = $id;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('invoiceNumber')
                ->add('date', 'date', array('label' => 'Field', 'data' => new \DateTime("now")))
                ->add('companyStreet', 'text', array('label' => 'Stra&szlig;e', 'attr' => array('class' => '')))
                ->add('companyZip', 'text', array('label' => 'PLZ', 'attr' => array('class' => '')))
                ->add('companyLocation', 'text', array('label' => 'Ort', 'attr' => array('class' => '')))
                ->add('companyCountry', 'text', array('label' => 'Land', 'attr' => array('class' => '')))
                ->add('companyPhone', 'text', array('label' => 'Telefon', 'attr' => array('class' => '')))
                ->add('customerNumber')
                ->add('payment')
                ->add('customerStreet', 'text', array('label' => 'Stra&szlig;e', 'attr' => array('class' => '')))
                ->add('customerZip', 'text', array('label' => 'PLZ', 'attr' => array('class' => '')))
                ->add('customerLocation', 'text', array('label' => 'Ort', 'attr' => array('class' => '')))
                ->add('customerCountry', 'text', array('label' => 'Land', 'attr' => array('class' => '')))
                ->add('customerPhone', 'text', array('label' => 'Telefon', 'attr' => array('class' => '')))
                ->add('invoicepos', 'collection', array(
                        'type' => new InvoiceposType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'prototype' => true,
                        'by_reference' => false,
                    ))
                

                ->add('note', 'textarea', array('label' => 'Bemerkung', 'attr' => array('class' => '')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Invoice',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_letsplaybundle_invoice';
    }

}
