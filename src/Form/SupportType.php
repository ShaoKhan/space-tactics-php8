<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SupportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class
                , [
                    'label' => 'Betreff',
                    'attr' => [
                        'class' => 'form-control mb-2',
                        'placeholder' => 'Betreff',
                    ],
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'Bitte geben Sie einen Betreff ein',
                            ]
                        ),
                    ],
                ]
            )

            ->add('theme', ChoiceType::class
                , [
                    'label' => 'Thema',
                    'attr' => [
                        'class' => 'form-control mb-2',
                        'placeholder' => 'Thema',
                    ],
                    'choices' => [
                        'bitte wählen' => '',
                        'ich habe einen Bug gefunden' => 'Bug',
                        'ein Problem mit anderem Spieler' => 'Spieler',
                        'Technische Probleme' => 'Technisch',
                        'Sonstiges' => 'Sonstiges',
                    ],
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'Bitte wählen Sie ein Thema aus',
                            ]
                        ),
                    ],
                ])

            ->add('message', TextareaType::class
                , [
                    'label' => 'Nachricht',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Nachricht',
                    ],
                ]
            )

            ->add('submit', SubmitType::class
                , [
                    'label' => 'Absenden',
                    'attr' => [
                        'class' => 'btn btn-primary mt-4',
                    ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
