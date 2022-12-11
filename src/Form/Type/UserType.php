<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('username', TextType::class, [
                'label'      => 'Benutzername',
                'label_attr' => [
                    'class' => 'col-1 col-form-label',
                    'for'   => 'username',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'username',
                    'placeholder' => 'Benutzername',
                ],
                'required'   => TRUE,
            ])
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
                'required'   => TRUE,
            ])
            ->add('password', PasswordType::class, [
                'label'      => 'Passwort',
                'label_attr' => [
                    'class' => 'col-1 col-form-label',
                    'for'   => 'password',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'password',
                    'placeholder' => 'Passwort',
                ],
                'required'   => TRUE,
            ])
            ->add('uni', ChoiceType::class, [
                'choices'    => [
                    'Universum 1' => 1,
                ],
                'label'      => 'Universum',
                'label_attr' => [
                    'class' => 'col-1 col-form-label',
                    'for'   => 'universe',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'universe',
                    'placeholder' => 'Universum',
                ],
                'required'   => TRUE,
            ])
            ->add('locale', ChoiceType::class, [
                'choices'    => [
                    'Deutsch'  => 'de-DE',
                    'English'  => 'en-GB',
                    'Polski'   => 'pl_PL',
                    'Italiano' => 'it-IT',
                    'Français' => 'fr-FR',
                    'Türkçe'   => 'tr-TR',
                    'Русский'  => 'ru-RU',
                ],
                'label'      => 'Sprache',
                'label_attr' => [
                    'class' => 'col-1 col-form-label',
                    'for'   => 'sprache',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'sprache',
                    'placeholder' => 'Sprache',
                ],
                'required'   => TRUE,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Registrieren',
                'attr'  => [
                    'class' => 'btn btn-primary mt-3',
                ],
            ])
            ->getForm();
    }
    
}