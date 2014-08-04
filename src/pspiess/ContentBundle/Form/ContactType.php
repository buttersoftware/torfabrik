<?php

namespace pspiess\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ContactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text', array(
                    'label' => 'Name',
                    'attr' => array(
                        'label' => 'Name',
                        'placeholder' => 'Ihr Name',
                        'pattern' => '.{2,}', //minlength
                        'class' => 'span8'
                    )
                ))
                ->add('email', 'email', array(
                    'label' => 'Email',
                    'attr' => array(
                        'placeholder' => 'Ihre E-Mail Adresse',
                        'class' => 'span8'
                    )
                ))
                ->add('subject', 'text', array(
                    'label' => 'Betreff',
                    'attr' => array(
                        'placeholder' => 'Ihr Betreff',
                        'pattern' => '.{3,}',
                        'class' => 'span8' //minlength
                    )
                ))
                ->add('message', 'textarea', array(
                    'label' => 'Nachricht',
                    'attr' => array(
                        'cols' => 25,
                        'rows' => 5,
                        'placeholder' => 'Tragen Sie hier Ihre Nachricht ein...',
                        'class' => 'span8'
            )))
                ->add('submit', 'submit', array(
                    'label' => 'Nachricht senden',
                    'attr' => array(
                        'class' => 'btn btn-large btn-info'
        )));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $collectionConstraint = new Collection(array(
            'name' => array(
                new NotBlank(array('message' => 'Der Name darf nicht leer bleiben.')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Die Email darf nicht leer bleiben.')),
                new Email(array('message' => 'Invalid email address.'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'Der Betreff darf nicht leer bleiben.')),
                new Length(array('min' => 3))
            ),
            'message' => array(
                new NotBlank(array('message' => 'Die Nachricht darf nicht leer bleiben.')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName() {
        return 'contact';
    }

}
