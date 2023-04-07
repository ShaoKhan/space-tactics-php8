<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('from_uuid', HiddenType::class, [
                'data' => $options['data']->getFromUuid(),
            ])
            ->add('from_name')
            ->add('to_uuid')
            ->add('to_name')
            ->add('send_date')
            ->add('message')
            ->add('was_read')
            ->add('deleted')
            ->add('answered')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
