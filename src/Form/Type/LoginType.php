<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('email', TextType::class, [
                'label'      => 'E-Mail',
                'label_attr' => [
                    'class' => 'col-1 col-form-label',
                    'for'   => 'email',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'email',
                    'placeholder' => 'E-Mail',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label'      => 'Passwort',
                'label_attr' => [
                    'class' => 'col-1 col-form-label',
                    'for'   => 'pass',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'pass',
                    'placeholder' => 'Passwort',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Anmelden',
                'attr'  => [
                    'class' => 'btn btn-primary',
                ],
            ])
            ->getForm();
    }
    
}