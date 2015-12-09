<?php

namespace pspiess\LetsplayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('customernr', 'number', array('label' => 'Kundennummer', 'attr' => array('class' => '')))
                ->add('title', 'choice', array('label' => 'Anrede', 'attr' => array('class' => ''),
                    'choices' => array('' => '', 'Herr' => 'Herr', 'Frau' => 'Frau', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.'),
                    'preferred_choices' => array('')))
                ->add('name', 'text', array('label' => 'Nachname', 'attr' => array('class' => '')))
                ->add('firstname', 'text', array('label' => 'Vorname', 'attr' => array('class' => ''), 'required' => false))
                ->add('addon', 'text', array('label' => 'Zusatz', 'attr' => array('class' => ''), 'required' => false))
                ->add('street', 'text', array('label' => 'Straße', 'attr' => array('class' => ''), 'required' => false))
                ->add('email', 'email', array('label' => 'Email', 'attr' => array('class' => ''), 'required' => false))
                ->add('zip', 'text', array('label' => 'PLZ', 'attr' => array('class' => ''), 'required' => false))
                ->add('location', 'text', array('label' => 'Ort', 'attr' => array('class' => ''), 'required' => false))
                ->add('country', 'text', array('label' => 'Land', 'attr' => array('class' => ''), 'required' => false))
                ->add('phone', 'text', array('label' => 'Telefon', 'attr' => array('class' => '')))
                ->add('mobile', 'text', array('label' => 'Mobil', 'attr' => array('class' => ''), 'required' => false))
                ->add('fax', 'text', array('label' => 'Fax', 'attr' => array('class' => ''), 'required' => false))
                ->add('contactPerson', 'text', array('label' => 'Ansprechpartner', 'attr' => array('class' => ''),  'required' => false))
                ->add('contactPersonPhone', 'text', array('label' => 'Telefon', 'attr' => array('class' => ''), 'required' => false))
                ->add('note', 'text', array('label' => 'Bemerkung', 'attr' => array('class' => ''), 'required' => false))
                ->add('discount', 'money', array('label' => 'Rabatt', 'attr' => array('class' => ''), 'required' => false))
                ->add('birthday', 'date', array('years' => range(1950, 2005), 'empty_value' => array('year' => 'Jahr', 'month' => 'Monat', 'day' => 'Tag'), 
                    'label' => 'Geburtstag', 'attr' => array('class' => ''), 'required' => false))
                ->add('sex', 'choice', array('label' => 'Geschlecht', 'attr' => array('class' => ''),
                    'choices' => array('M' => 'männlich', 'W' => 'weiblich'),
                    'preferred_choices' => array(''), 'required' => false))
                ->add('sepa', 'text', array('label' => 'SEPA', 'attr' => array('class' => ''), 'required' => false))
                ->add('bic', 'text', array('label' => 'BIC', 'attr' => array('class' => ''), 'required' => false))
                ->add('cashing', 'choice', array('label' => 'Einzug', 'attr' => array('class' => ''),
                    'choices' => array('0' => 'Nein', '1' => 'Ja'),
                    'preferred_choices' => array('Nein'), 'required' => false))
                ->add('bank', 'text', array('label' => 'Bank', 'attr' => array('class' => ''), 'required' => false))
                ->add('bankOwner', 'text', array('label' => 'Inhaber', 'attr' => array('class' => ''), 'required' => false))
//                ->add('path', 'hidden', array('label' => 'Inhaber', 'attr' => array('class' => ''), 'required' => false))
                ->add('picture', 'file', array('label' => 'Bild', 'required' => false))
                ->add('blocked', 'choice', array('label' => 'gesperrt', 'attr' => array('class' => ''),
                    'choices' => array('1' => 'Ja', '0' => 'Nein'),
                    'preferred_choices' => array('0'), 'required' => false))
                ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'pspiess\LetsplayBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pspiess_letsplaybundle_customer';
    }

}
