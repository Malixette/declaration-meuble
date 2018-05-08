<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('heb_name', TextType::class, [
                'required'  => true,
                'label'     => "Nom de votre hébergement",
                'attr'      => [
                    'placeholder'   => "Ex: Chalet Bellevue",
                    'class'         => "input"
                ]    
            ])
            
            ->add('heb_adresse', TextType::class, [
                'required'  => true,
                'disabled' => $options['is_edit'],
                'label'     => "Adresse",
                'attr'      => [
                    'placeholder'   => "3 rue des Lilas",
                    'id'            => "autocomplete",
                    'type'          => "input",
                ]    
            ])

            ->add('heb_adresse_complement', TextType::class, [
                'required'  => false,
                'disabled' => $options['is_edit'],
                'label'     => "Complément d'adresse ",
                'attr'      => [
                    'placeholder'   => "Complément d'adresse",
                    'class'         => "input"
                ]    
            ])
            
            ->add('heb_batiment', TextType::class, [
                'required'  => false,
                'disabled' => $options['is_edit'],
                'label'     => "Bâtiment",
                'attr'      => [
                    'placeholder'   => "Bâtiment",
                    'class'         => "input"
                ]    
            ])
            ->add('heb_etage', IntegerType::class, [
                'required'  => false,
                'disabled' => $options['is_edit'],
                'label'     => "Numéro d'étage",
                'attr'      => [
                    'placeholder'   => "0 pour un rez-de-chaussée",
                    'class'         => "input",
                    'min'           => 0,
                    'max'           => 20,
                ]    
            ])
            
            ->add('heb_code_postal', NumberType::class, [
                'required'  => true,
                'disabled'  => $options['is_edit'],
                // ||$options['is_new'],
                'label'     => "Code postal",
                'attr'      => [
                    'placeholder'   => "Code postal",
                    'class'         => "input",
                    'name'          => "postal_code",
                ]    
            ])
            
            ->add('heb_commune', TextType::class, [
                'required'  => true,
                'disabled' => $options['is_edit'],
                // ||$options['is_new'],
                'label'     => "Ville",
                'attr'      => [
                    'placeholder'   => "Commune",
                    'class'         => "input",
                    'id'            => "locality",
                ]    
            ])
            
            ->add('heb_lat', NumberType::class, [
            'required'  => true,
                'disabled' => $options['is_new'],
                'label'     => "Latitude"
            ])
            
            ->add('heb_long', NumberType::class, [
            'required'  => true,
                'disabled' => $options['is_new'],
                'label'     => "Longitude"
            ])
            
            ->add('heb_type', ChoiceType::class, array(
                'disabled' => $options['is_edit'],
                'choices'  => array(
                    'Maison'        => 'maison',
                    'Appartement'   => 'appartement',
                    'Autre'         => 'autre',
                ),
                'label' => 'Type d\'hébergement',
                'required'  => true,
            ))
            
            ->add('heb_nbr_pieces', IntegerType::class, [
                'required'  => true,
                'disabled' => $options['is_edit'],
                'label'     => 'Nombre de pièces de votre hébergement:',
                'attr'      => [
                    'min' => 0,
                    'max' => 50
                ]    
            ])
            
            ->add('heb_couchages_max', IntegerType::class, [
                'required'  => true,
                'disabled' => $options['is_edit'],
                'label'     => "Nombre de couchages maximal",
                'attr'      => [
                    'placeholder'   => "Nombre de couchages maximal",
                    'class'         => "input",
                    'min' => 0,
                    'max' => 30
                ]    
            ])
            
            ->add('heb_classement', ChoiceType::class, [
                'choices'  => [
                    'En cours'   => 'en cours',
                    'Oui'       => 'oui',
                    'Non'       => 'non',
                ],
                'attr' => [
                    'type' => 'select'
                ],
                'disabled'  => $options['is_edit'],
                'label'     => 'Votre logement est-il classé?',
                'required'  => true,
            ])
            
            ->add('heb_date_classement', DateType::class, array(
                'widget'    => 'choice',
                'disabled'  => $options['is_edit'],
                'label'     => "Si oui, date de classement",
            ))
            
            ->add('heb_periodes_location',ChoiceType::class, [
                'label'        => "Période de location",
                'disabled'     => $options['is_edit'],
                'multiple'     => true,
                'expanded'     => true,
                'choices'      => array(
                    'Printemps'=> 'Printemps', 
                    'Eté'      => 'Eté', 
                    'Automne'  => 'Automne',
                    'Hiver'    => 'Hiver'
                )
            ])

            // ->add('heb_date_declaration')
            
            // ->add('heb_cerfa')
            
            ->add('heb_descriptif_court',TextareaType::class, [
                'required'  => false,
                'label'     => "Descriptif de l'hébergement",
                'attr'      => [
                    'placeholder' => "Ex: Charmante maison de pays dans un cadre reposant... ou Appartement moderne en plein coeur du centre de la ville...",
                    'class' => "textarea",
                    'cols'  => '50', 
                    'rows'  => '3'
                ]
            ])
            ->add('heb_photo_1', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                'label'         => 'Ajouter une photo principale',   
            ))
            
            ->add('heb_photo_2', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                'label'         => 'Ajouter une autre photo',   
            ))
            
            ->add('heb_photo_3', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                'label'         => 'Ajouter une autre photo',   
            ))

            
            ->add('heb_site_web', TextType::class, [
                'required'  => false,
                'label'     => 'Adresse web de votre hébergement',
                'attr'      => [
                    'placeholder'   => "Site internet de votre hébergement : www.",
                    'class'         => "input"
                ]    
            ])
            
            ->add('heb_site_resa', TextType::class, [
                'required'  => false,
                'label'     => "Si vous disposez d'une réservation en ligne, renseignez votre lien de réservation",
                'attr'      => [
                    'placeholder'   => "booking, tripadvisor, etc",
                    'class'         => "input"
                ]    
            ])
            
            ->add('heb_contact_resa', TextType::class, [
                'required'  => false,
                'label'     => "Contact ou nom de l'organisme de gestion de réservation de votre hébergement",
                'attr'      => [
                    'placeholder'   => "Ex: Matthieu DUPONT ou Agence de location de la Montagne ",
                    'class'         => "input"
                ]    
            ])
            
            ->add('heb_email_resa', TextType::class, [
                'required'  => false,
                'label'     => "Email de réservation",
                'attr'      => [
                    'placeholder'   => "monemail@mail.com",
                    'class'         => "input"
                ]    
            ])
            
            ->add('heb_tel_resa', NumberType::class, [
                'required'  => false,
                'label'     => "Numéro de téléphone de réservation",
                'attr'      => [
                    'placeholder'   => "06 01 02 03 04",
                    'class'         => "input"
                ]    
            ])

            // ->add('heb_num_declaration',TextType::class, [
            //     'label' => "Numéro de déclaration",
            //     'attr'      => [
            //         'placeholder'   => "",
            //         'class'         => "input"
            //     ]  
            // ])

            ->add('heb_num_voie', NumberType::class, [
                'required'  => false,
                'disabled'  => $options['is_new'],
                'label'     => "Numero de voie",
                'attr'      => [
                    'placeholder'   => "N° de voie",
                    'class'         => "input"
                ]    
            ])
            
            
            // ->add('heb_date_creation')
            // ->add('heb_statut')
            // ->add('heb_date_suppression')
            // ->add('user')
            // ->add('mairie')
            // ->add('officeTourisme')
            // ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
            'is_edit' => false,
            'is_new' => false,
        ]);
    }
}
