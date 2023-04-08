<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slug', HiddenType::class)
            ->add(
                'message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control message-body',
                ],
            ],
            )
            ->add(
                'save', SubmitType::class, [
                    'label' => 'Abschicken',
                'attr' => [
                    'class' => 'btn btn-primary mt-2',
                ],
            ],
            );
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Messages::class,
            ],
        );
    }
}
