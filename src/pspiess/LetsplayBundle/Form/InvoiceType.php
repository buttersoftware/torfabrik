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
                ->add('invoiceNumber', 'hidden', array('label' => ''))
                ->add('date', 'date', array('label' => 'Field', 'data' => new \DateTime("now")))
                ->add('companyStreet', 'text', array('label' => 'Stra&szlig;e', 'attr' => array('class' => '')))
                ->add('companyZip', 'text', array('label' => 'PLZ', 'attr' => array('class' => '')))
                ->add('companyLocation', 'text', array('label' => 'Ort', 'attr' => array('class' => '')))
                ->add('companyCountry', 'text', array('label' => 'Land', 'attr' => array('class' => '')))
                ->add('companyPhone', 'text', array('label' => 'Telefon', 'attr' => array('class' => '')))
                ->add('customerNumber', 'text', array('label' => 'Kundennummer', 'attr' => array()))
                ->add('payment', 'choice', array('label' => 'Zahlung', 'attr' => array('class' => ''),
                    'choices' => array('Bar' => 'Bar', 'EC Karte' => 'EC - Karte', 'Kreditkarte' => 'Kreditkarte', 'Überweisung' => 'Überweisung'),
                    'preferred_choices' => array('Bar'), 'required' => true))
                ->add('customerStreet', 'text', array('label' => 'Stra&szlig;e', 'attr' => array('class' => '')))
                ->add('customerZip', 'text', array('label' => 'PLZ', 'attr' => array('class' => '')))
                ->add('customerLocation', 'text', array('label' => 'Ort', 'attr' => array('class' => '')))
                ->add('customerCountry', 'text', array('label' => 'Land', 'attr' => array('class' => '')))
                ->add('customerPhone', 'text', array('label' => 'Telefon', 'attr' => array('class' => '')))
                ->add('TotalPrice', 'money', array('label' => 'Bruttopreis', 'attr' => array('class' => '')))
                ->add('TotalPricenet', 'money', array('label' => 'Nettopreis', 'attr' => array('class' => '')))
                ->add('tax', 'money', array('label' => 'Mehrwertssteuer', 'attr' => array('class' => '')))
                ->add('PaidPrice', 'money', array('label' => 'Bereits bezahlt', 'attr' => array('class' => '')))
                ->add('note', 'textarea', array('label' => 'Bemerkung', 'attr' => array('class' => '')))
                ->add('taxNumber', 'text', array('label' => 'Steuernummer', 'attr' => array('class' => '')))
                ->add('customerFirstname', 'text', array('label' => 'Vorname', 'attr' => array('class' => '')))
                ->add('customerName', 'text', array('label' => 'Nachname', 'attr' => array('class' => '')))
                ->add('invoicepos', 'collection', array(
                        'type' => new InvoiceposType(),
                        'allow_add'    => true,
                        'allow_delete' => true,
                        'cascade_validation' => true,
                        'by_reference' => true,
                    ))
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
