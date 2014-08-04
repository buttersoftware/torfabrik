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
                ->add('customernr', 'number', array('label' => 'Kundennummer', 'attr' => array('class' => 'input-xxlarge')))
                ->add('title', 'choice', array('label' => 'Titel', 'attr' => array('class' => 'input-xxlarge'),
                    'choices' => array('' => '', 'Herr' => 'Herr', 'Frau' => 'Frau', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.'),
                    'preferred_choices' => array(''), 'required' => false))
                ->add('name', 'text', array('label' => 'Nachname', 'attr' => array('class' => 'input-xxlarge')))
                ->add('firstname', 'text', array('label' => 'Vorname', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('addon', 'text', array('label' => 'Zusatz', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('street', 'text', array('label' => 'Straße', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('zip', 'text', array('label' => 'PLZ', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('location', 'text', array('label' => 'Ort', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('country', 'text', array('label' => 'Land', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('phone', 'text', array('label' => 'Telefon', 'attr' => array('class' => 'input-xxlarge')))
                ->add('mobile', 'text', array('label' => 'Mobil', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('fax', 'text', array('label' => 'Fax', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('note', 'text', array('label' => 'Bemerkung', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('discount', 'text', array('label' => 'Rabatt', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('birthday', 'text', array('label' => 'Geburtstag', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('sex', 'choice', array('label' => 'Geschlecht', 'attr' => array('class' => 'input-xxlarge'),
                    'choices' => array('M' => 'männlich', 'W' => 'weiblich'),
                    'preferred_choices' => array(''), 'required' => false))
                ->add('sepa', 'text', array('label' => 'SEPA', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('bic', 'url', array('label' => 'BIC', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('cashing', 'choice', array('label' => 'Einzug', 'attr' => array('class' => 'input-xxlarge'),
                    'choices' => array('0' => 'Nein', '1' => 'Ja'),
                    'preferred_choices' => array('Nein'), 'required' => false))
                ->add('bank', 'text', array('label' => 'Bank', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('bankOwner', 'url', array('label' => 'Inhaber', 'attr' => array('class' => 'input-xxlarge'), 'required' => false))
                ->add('picture', 'file', array('label' => 'Bild', 'required' => false));
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
