<?php

namespace App\Form;

use App\Entity\Server;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ServerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('game_name', TextType::class, [
                'label'      => 'Game-Name',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'game_name',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'game_name',
                ],
                'required'   => TRUE,

            ])
            ->add('timezone', ChoiceType::class, [
                'choices'    => [
                    'Select'             => '',
                    'Europe/Berlin'      => "(GMT+01:00) Berlin",
                    'US/Central'         => "(GMT-06:00) Central Time (US &amp; Canada)",
                    'US/Eastern'         => "(GMT-05:00) Eastern Time (US &amp; Canada)",
                    'Europe/Dublin'      => "(GMT) Dublin",
                    'Europe/Athens'      => "(GMT+02:00) Athens",
                    'Europe/Moscow'      => "(GMT+03:00) Moscow",
                    'Asia/Tbilisi'       => "(GMT+04:00) Tbilisi",
                    'Asia/Tashkent'      => "(GMT+05:00) Tashkent",
                    'Asia/Bangkok'       => "(GMT+07:00) Bangkok",
                    'Asia/Hong_Kong'     => "(GMT+08:00) Hong Kong",
                    'Asia/Tokyo'         => "(GMT+09:00) Tokyo",
                    'Australia/Canberra' => "(GMT+10:00) Canberra",
                    'Asia/Vladivostok'   => "(GMT+11:00) Vladivostok",
                    'Pacific/Fiji'       => "(GMT+12:00) Fiji",
                ],
                'label'      => 'Zeitzone',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'timezone',
                ],
                'attr'       => [
                    'class'       => 'form-control',
                    'id'          => 'timezone',
                    'placeholder' => 'Zeitzone',
                ],
            ])
            ->add('msg_delete_after', TextType::class, [
                'label'      => 'Lösche Nachrichten nach:',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'msg_delete_after',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'msg_delete_after',
                ],
                'required'   => TRUE,
            ])
            ->add('user_delete_after', TextType::class, [
                'label'      => 'Lösche User nach:',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'user_delete_after',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'user_delete_after',
                ],
                'required'   => TRUE,
            ])
            ->add('inactive_delete_after', TextType::class, [
                'label'      => 'Lösche Inaktive nach:',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'inactive_delete_after',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'inactive_delete_after',
                ],
                'required'   => TRUE,
            ])
            ->add('reminder_mail', CheckboxType::class, [
                'label'      => 'Erinnerungs Mail:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'form-check-label',
                    'for'   => 'reminder_mail',
                ],
                'attr'       => [
                    'type'  => 'checkbox',
                    'class' => 'form-check-input',
                    'id'    => 'reminder_mail',
                ],
            ])
            ->add('send_reminder_after', TextType::class, [
                'label'      => 'Erinnerungs Mail nach X inaktiven Tagen versenden:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-6 col-form-label',
                    'for'   => 'send_reminder_after',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'send_reminder_after',
                ],
            ])
            ->add('activate_emails', CheckboxType::class, [
                'label'      => 'E-Mailversand aktivieren:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'form-check-label',
                    'for'   => 'activate_emails',
                ],
                'attr'       => [
                    'class' => 'form-check-input',
                    'id'    => 'activate_emails',
                ],
            ])
            ->add('sender_type', ChoiceType::class, [
                'choices'    => [
                    'se_mail_sel' => 'se_mail_sel',
                ],
                'required'   => FALSE,
                'label'      => 'Mail Versand',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'user_delete_after',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'user_delete_after',
                ],
            ])
            ->add('sender_mail', TextType::class, [
                'label'      => 'E-Mail Absender:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'sender_mail',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'sender_mail',
                ],
            ])
            ->add('sendmailpath', TextType::class, [
                'label'      => 'Pfad zu sendmail:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'sendmailpath',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'sendmailpath',
                ],
            ])
            ->add('smtp_host', TextType::class, [
                'label'      => 'SMTP Host:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'smtp_host',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'smtp_host',
                ],
            ])
            ->add('smtp_ssl_tls', ChoiceType::class, [
                'choices'    => [
                    'keine Verschlüsselung' => 0,
                    'SSL'                   => 1,
                    'TLS'                   => 2,
                ],
                'required'   => FALSE,
                'label'      => 'Verschlüsselung:',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'smtp_ssl_tls',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'smtp_ssl_tls',
                ],
            ])
            ->add('smtp_port', TextType::class, [
                'label'      => 'SMTP Port:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'smtp_port',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'smtp_port',
                ],
            ])
            ->add('smtp_username', TextType::class, [
                'label'      => 'SMTP Benutzername:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'smtp_username',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'smtp_username',
                ],
            ])
            ->add('smtp_password', TextType::class, [
                'label'      => 'SMTP Passwort:',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'smtp_password',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'smtp_password',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Server Speichern',
                'attr'  => [
                    'class' => 'btn btn-primary mt-3',
                ],
            ])
            ->getForm();;
    }
}
