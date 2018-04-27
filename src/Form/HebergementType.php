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

class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heb_adresse', TextType::class, [
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Adresse de l'hébergement",
                    'class'         => "input"
                ]    
            ])
            ->add('heb_adresse_complement', TextType::class, [
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Complément d'adresse",
                    'class'         => "input"
                ]    
            ])
            ->add('heb_batiment', TextType::class, [
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Bâtiment",
                    'class'         => "input"
                ]    
            ])
            ->add('heb_etage', IntegerType::class, [
                'required'  => false,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Numéro d'étage",
                    'class'         => "input"
                ]    
            ])
            ->add('heb_code_postal', IntegerType::class, [
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Code postal",
                    'class'         => "input"
                ]    
            ])
            ->add('heb_commune', TextType::class, [
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Commune",
                    'class'         => "input"
                ]    
            ])
            // ->add('heb_lat')
            // ->add('heb_long')
            
            ->add('heb_type', ChoiceType::class, array(
                'choices'  => array(
                    'Maison'        => null,
                    'Appartement'   => true,
                    'Autre' => false,
                ),
                'label' => 'Type d\'hébergement',
                'required'  => true,
            ))
            ->add('heb_nbr_pieces', IntegerType::class, [
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder'   => "Nombre de pièce de l'hébergement",
                    'class'         => "input",
                ]    
            ])
            ->add('heb_couchages_max')
            ->add('heb_classement')
            ->add('heb_date_classement')
            ->add('heb_periodes_location')
            ->add('heb_date_declaration')
            ->add('heb_cerfa')
            ->add('heb_descriptif_court',TextareaType::class, [
                'required'  => false,
                'attr'      => [
                    'placeholder' => "Descriptif de votre article",
                    'class' => "textarea"
                ]
            ])
            ->add('heb_photo_1')
            ->add('heb_photo_2')
            ->add('heb_photo_3')
            ->add('heb_site_web')
            ->add('heb_site_resa')
            ->add('heb_contact_resa')
            ->add('heb_email_resa')
            ->add('heb_tel_resa')
            ->add('heb_date_creation')
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
        ]);
    }
}
