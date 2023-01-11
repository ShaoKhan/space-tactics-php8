<?php

namespace App\Form;

use App\Entity\Uni;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UniType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uni_enabled', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => 1,
                    'Nein' => 2,
                ],
                'label'      => 'Universum aktiv?',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'message_delete_behavior',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'message_delete_behavior',
                ],
            ])
            ->add('uni_name', TextType::class, [
                'label'      => 'Name des Universums',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'uni_name',
                ],
                'attr'       => [
                    'class'   => 'form-control',
                    'id'      => 'uni_name',
                    'checked' => 'checked',
                ],
            ])
            ->add('game_speed', TextType::class, [
                'label'      => 'Spielgeschwindigkeit',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'game_speed',
                ],
                'attr'       => [
                    'class' => 'form-control col-l6-3',
                    'id'    => 'game_speed',
                    'value' => 7,
                ],
            ])
            ->add('fleet_speed', TextType::class, [
                'label'      => 'Flottengeschwindigkeit',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'fleet_speed',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'fleet_speed',
                    'value' => 7,
                ],
            ])
            ->add('resource_multiplier', TextType::class, [
                'label'      => 'Resourcen Multiplikator',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'resource_multiplier',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'resource_multiplier',
                    'value' => 3,
                ],
            ])
            ->add('storage_multiplier', TextType::class, [
                'label'      => 'Speicher Multiplikator',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'storage_multiplier',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'storage_multiplier',
                    'value' => 3,
                ],
            ])
            ->add('energy_standard_income', TextType::class, [
                'label'      => 'Standard Energie / Stunde',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'energy_standard_income',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'energy_standard_income',
                    'value' => 50,
                ],
            ])
            ->add('energy_factor', TextType::class, [
                'label'      => 'Energiefaktor',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'energy_factor',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'energy_factor',
                    'value' => 2,
                ],
            ])
            ->add('halt_speed', TextType::class, [
                'label'      => 'Expeditionsgesxchwindigkeit',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'halt_speed',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'halt_speed',
                    'value' => 3,
                ],
            ])
            ->add('message_delete_behavior', ChoiceType::class, [
                'choices'    => [
                    'Bitte wählen' => NULL,
                    'Soft-Delete'  => 1,
                    'Hard-Delete'  => 0,

                ],
                'required'   => FALSE,
                'label'      => 'Nachrichten Lösch-Verhalten',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'message_delete_behavior',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'message_delete_behavior',
                ],
            ])
            ->add('message_delete_days', TextType::class, [
                'label'      => 'Nachrichten löschen X Tagen',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'message_delete_days',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'message_delete_days',
                    'value' => 14,
                ],
            ])
            ->add('fleet_cdr', TextType::class, [
                'label'      => 'TF aus X Prozent der Flotte',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'fleet_cdr',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'fleet_cdr',
                    'value' => 70,
                ],
            ])
            ->add('def_in_tf', TextType::class, [
                'label'      => 'TF aus X Prozent der Verteidigung',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'def_in_tf',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'def_in_tf',
                    'value' => 70,
                ],
            ])
            ->add('planet_fields', TextType::class, [
                'label'      => 'Anzahl Felder des Startplaneten',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'planet_fields',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'planet_fields',
                    'value' => 163,
                ],
            ])
            ->add('closed_text', TextType::class, [
                'label'      => 'Schließgrund des Universums',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'closed_text',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'closed_text',
                    'value' => 'Aufgrund von Dingen ist das Universum erst mal zu',
                ],
            ])
            ->add('metal_standard_income', TextType::class, [
                'label'      => 'Standard Metall / Stunde',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'metal_standard_income',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'metal_standard_income',
                    'value' => 50,
                ],
            ])
            ->add('crystal_standard_income', TextType::class, [
                'label'      => 'Standard Kristall / Stunde',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'crystal_standard_income',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'crystal_standard_income',
                    'value' => 25,
                ],
            ])
            ->add('deuterium_standard_income', TextType::class, [
                'label'      => 'Standard Deuterium / Stunde',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'deuterium_standard_income',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'deuterium_standard_income',
                    'value' => 10,
                ],
            ])
            ->add('noob_protection', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => 1,
                    'Nein' => 0,
                ],
                'label'      => 'Noobschutz aktivieren?',
                'label_attr' => [
                    'class' => 'form-check-label',
                    'for'   => 'noob_protection',
                ],
                'attr'       => [
                    'class'   => 'form-control',
                    'id'      => 'noob_protection',
                    'checked' => 1,
                ],
            ])
            ->add('noob_protectiontime', TextType::class, [
                'label'      => 'Noobschutzdauer in Tagen',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'noob_protectiontime',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'noob_protectiontime',
                    'value' => 14,
                ],
            ])
            ->add('forum_url', TextType::class, [
                'label'      => 'URL zum Forum',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'forum_url',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'forum_url',
                ],
            ])
            ->add('admin_attackable', ChoiceType::class, [
                'choices'    => [
                    'Nein' => FALSE,
                    'Ja'   => TRUE,
                ],
                'label'      => 'Admins angreifbar',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'form-check-label col-lg-4 mt-3',
                    'for'   => 'admin_attackable',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'admin_attackable',
                ],
            ])
            ->add('language', ChoiceType::class, [
                'choices'    => [
                    'Deutsch'  => 'german',
                    'English'  => 'english',
                    'Polski'   => 'polski',
                    'Türk'     => 'türk',
                    'Italiano' => 'italiano',
                    'Русский'  => 'pусский',
                ],
                'label'      => 'Standard-Sprache des Universums',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'language',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'language',
                ],
            ])
            ->add('teamspeak_mod', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => TRUE,
                    'Nein' => FALSE,
                ],
                'label'      => 'Teamspeak aktivieren?',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'form-label col-lg-4',
                    'for'   => 'teamspeak_mod',
                ],
                'attr'       => [
                    'type'  => 'checkbox',
                    'class' => 'form-control',
                    'id'    => 'teamspeak_mod',
                ],
            ])
            ->add('teamspeak_server', TextType::class, [
                'label'      => 'IP des TS Servers',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'teamspeak_server',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'teamspeak_server',
                ],
            ])
            ->add('teamspeak_tcp_port', TextType::class, [
                'label'      => 'TCP Port des TS Servers',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'teamspeak_tcp_port',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'teamspeak_tcp_port',
                    'value' => 10011,
                ],
            ])
            ->add('teamspeak_udp_port', TextType::class, [
                'label'      => 'UDP Port des TS Servers',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'teamspeak_udp_port',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'teamspeak_udp_port',
                    'value' => 9987,
                ],
            ])
            ->add('registration_closed', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => 1,
                    'Nein' => 0,
                ],
                'label'      => 'Registrierung geschlossen ?',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'form-label',
                    'for'   => 'registration_closed',
                ],
                'attr'       => [
                    'type'  => 'checkbox',
                    'class' => 'form-control',
                    'id'    => 'registration_closed',
                ],
            ])
            ->add('welcome_text', TextType::class, [
                'label'      => 'Willkommensnachricht',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'welcome_text',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'welcome_text',
                    'value' => 'Herzlich Willkommen zu Space-Tactics. Wir freuen uns, dich hier begrüßen zu dürfen. Bei Fragen wende dich gern an die Admins / den Support.',
                ],
            ])
            ->add('min_build_time', TextType::class, [
                'label'      => 'Mindest-Bauzeit für Gebäude und Schiffe in Sekunden',
                'label_attr' => [
                    'class' => 'col-5 col-form-label col-lg-4',
                    'for'   => 'min_build_time',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'min_build_time',
                    'value' => 1,
                ],
            ])
            ->add('modules', TextType::class, [
                'label'      => 'aktivierte Module',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'modules',
                ],
                'attr'       => [
                    'class'    => 'form-control',
                    'id'       => 'modules',
                    'disabled' => 1,
                ],
            ])
            ->add('tradeable_ships', ChoiceType::class, [
                'choices'    => [
                    'kleiner Transporter'   => 10,
                    'mittlerer Transporter' => 11,
                    'Zerstörer'             => 25,
                ],
                'label'      => 'Schiff-Ids die gehandelt werden können',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'tradeable_ships',
                ],
                'attr'       => [
                    'class'    => 'form-control',
                    'id'       => 'tradeable_ships',
                    'multiple' => 1,
                    'size'     => 4,
                ],
            ])
            ->add('tradeable_ships_fee', TextType::class, [
                'label'      => 'Verschrottungskosten in %',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'tradeable_ships_fee',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'tradeable_ships_fee',
                    'value' => 30,
                ],
            ])
            ->add('galaxy_width', TextType::class, [
                'label'      => 'Breite des Universums (empfohlen max. 100)',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'galaxy_width',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'galaxy_width',
                    'value' => 200,
                ],
            ])
            ->add('galaxy_height', TextType::class, [
                'label'      => 'Höhe des Universums (empfohlen max. 100)',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'galaxy_height',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'galaxy_height',
                    'value' => 200,
                ],
            ])
            ->add('galaxy_depth', TextType::class, [
                'label'      => 'Anzahl Planeten in einem Feld',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'galaxy_depth',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'galaxy_depth',
                    'value' => 16,
                ],
            ])
            ->add('max_construction_count', TextType::class, [
                'label'      => 'Anzahl gleichzeitiger Bauten',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_construction_count',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_construction_count',
                    'value' => 3,
                ],
            ])
            ->add('max_science_count', TextType::class, [
                'label'      => 'Anzahl gleichzeitiger Forschungen',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_science_count',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_science_count',
                    'value' => 2,
                ],
            ])
            ->add('max_ship_count', TextType::class, [
                'label'      => 'Anzahl gleichzeitiger Schiffsbauten',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_ship_count',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_ship_count',
                    'value' => 5,
                ],
            ])
            ->add('max_start_planets_per_player', TextType::class, [
                'label'      => 'Besiedelbare Planeten (ohne Forschungen etc.)',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_start_planets_per_player',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_start_planets_per_player',
                    'value' => 8,
                ],
            ])
            ->add('max_planets_astrophysics', TextType::class, [
                'label'      => 'Zusätzliche Planeten mit Forschung Astrophysik',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_planets_astrophysics',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_planets_astrophysics',
                    'value' => 12,
                ],
            ])
            ->add('max_planets_officers', TextType::class, [
                'label'      => 'Zusätzliche Planeten durch Offiziere',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_planets_officers',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_planets_officers',
                    'value' => 14,
                ],
            ])
            ->add('max_planets_science', TextType::class, [
                'label'      => 'Zusätzliche Planeten durch Forschung',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_planets_science',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_planets_science',
                    'value' => 16,
                ],
            ])
            ->add('flight_deuterium_cost_per_click', TextType::class, [
                'label'      => 'Deuteriumkosten für 1 click',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'flight_deuterium_cost_per_click',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'flight_deuterium_cost_per_click',
                    'value' => 10,
                ],
            ])
            ->add('max_dm_missions', TextType::class, [
                'label'      => 'Anzahl paralleler DM-Missionen',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_dm_missions',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_dm_missions',
                    'value' => 2,
                ],
            ])
            ->add('max_resource_overflow', TextType::class, [
                'label'      => 'Maximale Überladung der Speicher/Tanks in %',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_resource_overflow',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_resource_overflow',
                    'value' => 5,
                ],
            ])
            ->add('moon_chance_factor', TextType::class, [
                'label'      => 'Multiplikator zur Entstehung eines Mondes',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'moon_chance_factor',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'moon_chance_factor',
                    'value' => 2,
                ],
            ])
            ->add('moon_chance', TextType::class, [
                'label'      => 'Chance auf Entstehung eines Mondes in %',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'moon_chance',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'moon_chance',
                    'value' => 9,
                ],
            ])
            ->add('delete_moon_debris', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => 1,
                    'Nein' => 0,
                ],
                'label'      => 'TF löschen nach Enstehung eines Mondes',
                'required'   => FALSE,
                'label_attr' => [
                    'class' => 'form-label col-4',
                    'for'   => 'delete_moon_debris',
                ],
                'attr'       => [
                    'type'    => 'checkbox',
                    'class'   => 'form-control',
                    'id'      => 'delete_moon_debris',
                    'checked' => TRUE,
                ],
            ])
            ->add('trader_dm_cost', TextType::class, [
                'label'      => 'DM Gebühren für Händler',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'trader_dm_cost',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'trader_dm_cost',
                    'value' => 750,
                ],
            ])
            ->add('university_factor_science', TextType::class, [
                'label'      => 'Verkürzung von Forschungen in % je Universität',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'university_factor_science',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'university_factor_science',
                    'value' => 5,
                ],
            ])
            ->add('max_fleets_per_association', TextType::class, [
                'label'      => 'Maximale Anzahl Flotten in einem Verband',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'max_fleets_per_association',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'max_fleets_per_association',
                    'value' => 16,
                ],
            ])
            ->add('min_umode_time', TextType::class, [
                'label'      => 'U-Mode Mindestdauer',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'min_umode_time',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'min_umode_time',
                    'value' => 7,
                ],
            ])
            ->add('gate_interval_time', TextType::class, [
                'label'      => 'Sprungtorwartezeit in Sekunden bis zur Wiederbenutzung',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'gate_interval_time',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'gate_interval_time',
                    'value' => 600,
                ],
            ])
            ->add('start_metal', TextType::class, [
                'label'      => 'Start Metall',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'start_metal',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'start_metal',
                    'value' => 10000,
                ],
            ])
            ->add('start_crystal', TextType::class, [
                'label'      => 'Start Kristall',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'start_crystal',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'start_crystal',
                    'value' => 5000,
                ],
            ])
            ->add('start_deuterium', TextType::class, [
                'label'      => 'Start Deuterium',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'start_deuterium',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'start_deuterium',
                    'value' => 2500,
                ],
            ])
            ->add('start_dm', TextType::class, [
                'label'      => 'Start dunkle Materie',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'start_dm',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'start_dm',
                    'value' => 500,
                ],
            ])
            ->add('referal_active', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => 1,
                    'Nein' => 0,
                ],
                'label'      => 'Referals aktiv?',
                'label_attr' => [
                    'class' => 'form-label col-4',
                    'for'   => 'referal_active',
                ],
                'attr'       => [
                    'class' => 'form-control mt-4',
                    'id'    => 'referal_active',
                ],
            ])
            ->add('referal_bonus_dm', TextType::class, [
                'label'      => 'Bonus bei Empfehlung',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'referal_bonus_dm',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'referal_bonus_dm',
                    'value' => 250,
                ],
            ])
            ->add('referal_minpoints', TextType::class, [
                'label'      => 'Mindestpunktzahl des Geworbenen für Bonuszahlung',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'referal_minpoints',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'referal_minpoints',
                    'value' => 2500,
                ],
            ])
            ->add('referal_max_referals', TextType::class, [
                'label'      => 'Wieviele Spieler darf ein Spieler werben?',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'referal_max_referals',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'referal_max_referals',
                    'value' => 10,
                ],
            ])
            ->add('del_user_manual', ChoiceType::class, [
                'choices'    => [
                    'Automatisch' => 1,
                    'Manuell'     => 0,
                ],
                'label'      => 'Benutzer manuell oder automatisch löschen?',
                'label_attr' => [
                    'class' => 'col-4 col-form-label',
                    'for'   => 'del_user_manual',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'del_user_manual',
                ],
            ])
            ->add('send_inavtive_mail', ChoiceType::class, [
                'choices'    => [
                    'Ja'   => 1,
                    'Nein' => 0,
                ],
                'label'      => 'E-Mail an Inaktive?',
                'label_attr' => [
                    'class' => 'form-label col-4',
                    'for'   => 'send_inavtive_mail',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'send_inavtive_mail',
                ],
            ])
            ->add('silo_size_factor', TextType::class, [
                'label'      => 'Faktor für die Größe des Raketensilos',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'silo_size_factor',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'silo_size_factor',
                    'value' => 1,
                ],
            ])
            ->add('alliance_min_points', TextType::class, [
                'label'      => 'Mindestpunktzahl zur Gründung einer Allianz',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'alliance_min_points',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'alliance_min_points',
                    'value' => 2500,
                ],
            ])
            ->add('expedition_res_limit', TextType::class, [
                'label'      => 'Menge Resourcen die von einer Expedition maximal erlangt werden',
                'label_attr' => [
                    'class' => 'col-4 col-form-label col-lg-4',
                    'for'   => 'expedition_res_limit',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'id'    => 'expedition_res_limit',
                    'value' => 100000000,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                                   'data_class' => Uni::class,

                               ]);
    }
}
