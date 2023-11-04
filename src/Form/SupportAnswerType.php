<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SupportAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class
                , [
                    'label' => 'Antwort',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Nachricht',
                        'rows' => '5',
                        'cols' => '50',
                    ],
                ]
            )

            ->add('ticketId', HiddenType::class,
                [
                    'attr' => [
                        'data-ticket' => '',
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
