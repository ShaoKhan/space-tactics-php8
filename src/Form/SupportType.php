<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                ]
            )


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
