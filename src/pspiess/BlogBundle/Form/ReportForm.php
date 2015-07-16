<?php

namespace pspiess\BlogBundle\Form;


use Symfony\Component\Form\AbstractType;

class ReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', 'text')
            ->add('username', 'text')
            ->add('emailAddress', 'email')
            //->add('registration') kennt er weil wir das als service definiert haben. Kann man als service setzen als unterform!
            ->add('plainPassword', 'repeated', [
                'type' => 'password',
                'first_options' => [
                    'label' => 'Password',
                ],
                'second_options' => [
                    'label' => 'Repeat',
                ],
            ])
            ->add('birthdate', 'birthday', [
                'required' => false,
                'format' => IntlDateFormatter::LONG,
            ]);

        if ('signup' === $options['mode']) {
            $builder->add('rules', 'checkbox', [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'groups' => 'Signup',
                        'message' => 'You must accept the rules.',
                    ]),
                ],
            ]);
        }
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'report';
        // TODO: Implement getName() method.
    }
}