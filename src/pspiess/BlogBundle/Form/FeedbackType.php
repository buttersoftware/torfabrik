<?php

namespace pspiess\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class FeedbackType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', 'text', array(
                'label' => 'Name',
                'attr' => array(
                    'label' => 'Name',
                    'placeholder' => 'Ihr Name (optional)',
                    'pattern' => '.{2,}', //minlength
                )
            ))
            ->add('email', 'email', array(
                'label' => 'E-Mail',
                'attr' => array(
                    'placeholder' => 'Ihre E-Mail-Adresse (optional, falls Feedback erwünscht)',
                )
            ))
            ->add('subject', 'text', array(
                'label' => 'Betreff',
                'attr' => array(
                    'placeholder' => '',
                )
            ))
            ->add('message', 'textarea', array(
                'label' => 'Nachricht',
                'attr' => array(
                    'cols' => 25,
                    'rows' => 5,
                    'placeholder' => 'Ihre Nachricht an mich (aus Spamschutz-Gründen bitte kein HTML verwenden)',
                )))
            ->add('submit', 'submit', array(
                'label' => 'Feedback senden',
                'attr' => array(
                    'class' => 'btn btn-large btn-info'
                )));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $collectionConstraint = new Collection(array(
            'name' => array(
                new NotBlank(array('message' => 'Der Name darf nicht leer bleiben.')),
                new Length(array('min' => 2, 'minMessage' => 'Bitte geben Sie mehr als 2 Zeichen ein.'))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Die Email darf nicht leer bleiben.')),
                new Email(array('message' => 'Die E-Mail-Adresse ist ungültig'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'Der Betreff darf nicht leer bleiben.')),
                new Length(array('min' => 3, 'minMessage' => 'Bitte geben Sie mehr als 3 Zeichen ein.'))
            ),
            'message' => array(
                new NotBlank(array('message' => 'Die Nachricht darf nicht leer bleiben.')),
                new Length(array('min' => 5, 'minMessage' => 'Bitte geben Sie mehr als 5 Zeichen ein.'))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName() {
        return 'feedback';
    }

}
