<?php

namespace App\Form;

use App\Entity\Mairie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class MairieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mairie_nom_touristique', TextType::class,  [
                'required' => true,
                'label' => 'Nom de la commune :',
                'attr' => [
                    'placeholder' => "Barcelonnette",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            // ->add('mairie_descriptif_1') null
            // ->add('mairie_descriptif_2') null
            // ->add('mairie_epci_rattachement') null
            ->add('mairie_maire_nom', TextType::class,  [
                'required' => true,
                'label' => 'Nom du Maire :',
                'attr' => [
                    'placeholder' => "Durand",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])           
            ->add('mairie_maire_prenom', TextType::class,  [
                'required' => true,
                'label' => 'Prénom du Maire :',
                'attr' => [
                    'placeholder' => "Alice",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            // ->add('mairie_adjoint_nom') null
            // ->add('mairie_adjoint_prenom') null
            ->add('mairie_contact_nom', TextType::class,  [
                'required' => true,
                'label' => 'Nom du responsable du compte :',
                'attr' => [
                    'placeholder' => "Germain",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])            
            ->add('mairie_contact_prenom', TextType::class,  [
                'required' => true,
                'label' => 'Prénom du responsable du compte :',
                'attr' => [
                    'placeholder' => "Vincent",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_telephone_contact', TextType::class,  [
                'required' => true,
                'label' => 'Téléphone :',
                'attr' => [
                    'placeholder' => "0102030405",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])            
            ->add('mairie_email_contact', EmailType::class,  [
                'required' => true,
                'label' => 'Email ',
                'attr' => [
                    'placeholder' => "vgermain@barcelonnette.fr",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "email"
                ]
            ])
            // ->add('mairie_latitude') SETTER
            // ->add('mairie_longitude') SETTER
            // ->add('mairie_photo_1') null
            // ->add('mairie_photo_2') null
            // ->add('mairie_photo_3') null
            // ->add('mairie_photo_4') null
            // ->add('mairie_taxe_sejour_gestionnaire') null
            // ->add('mairie_taxe_sejour_bareme') null
            // ->add('mairie_sejour_lien') null
            // ->add('mairie_contact_nom_prenom') null
            // ->add('mairie_de_telephone') null
            // ->add('mairie_sejour_email') null
            // ->add('mairie_rappel_texte') null
            // ->add('mairie_rappel_lien') null
            // ->add('mairie_logo') null
            // ->add('mairie_logo_2') null
            // ->add('mairie_date_inscription') SETTER
            // ->add('mairie_tampon') null
            // ->add('mairie_maire_signature') null
            // ->add('mairie_slug') SETTER
            // ->add('ville') null
            // ->add('officeTourisme') null
            ->add('valider', SubmitType::class, [
                'label' => 'Continuer',
                'attr' => [
                    'class' => 'btn btn-lg btn-success'    
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mairie::class,
            'is_edit' => false
        ]);
    }
}
