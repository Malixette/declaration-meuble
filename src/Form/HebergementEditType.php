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


class HebergementEditType extends AbstractType
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

            ->add('heb_descriptif_court',TextareaType::class, [
                'required'  => false,
                'label'     => "Descriptif de l'hébergement",
                'attr'      => [
                    'placeholder' => "Descriptif de votre hébergement",
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
