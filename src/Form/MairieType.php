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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class MairieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mairie_nom_touristique', TextType::class,  [
                'required' => false,
                'label' => 'Nom de la commune :',
                'attr' => [
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_descriptif_1',TextareaType::class, [
                'required'  => false,
                'label'     => "Descriptif de la commune",
                'attr'      => [
                    'placeholder' => "Ex: En plein coeur d'un massif préservé...",
                    'class' => "form-control form-control-lg mb-3",
                    'cols'  => '50', 
                    'rows'  => '3'
                ]
            ])
            ->add('mairie_descriptif_2',TextareaType::class, [
                'required'  => false,
                'label'     => "Descriptif détaillé de la commune",
                'attr'      => [
                    'placeholder' => "L'histoire de la commune s'est construite autour de la route de ...",
                    'class' => "form-control form-control-lg mb-3",
                    'cols'  => '50', 
                    'rows'  => '3'
                ]
            ])
            ->add('mairie_epci_rattachement', TextType::class,  [
                'required' => true,
                'label' => 'Nom du regroupement de communes à laquelle la commune appartient:',
                'attr' => [
                    'placeholder' => "Communauté de communes de... ou Communauté d'agglomération de...",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
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
            ->add('mairie_adjoint_nom', TextType::class,  [
                'required' => true,
                'label' => 'Nom du 1er(e) adjoint(e) :',
                'attr' => [
                    'placeholder' => "DELARC",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_adjoint_prenom', TextType::class,  [
                'required' => true,
                'label' => 'Prénom du 1er(e) adjoint(e) :',
                'attr' => [
                    'placeholder' => "Dominique",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_contact_nom', TextType::class,  [
                'required' => false,
                'label' => 'Nom du responsable technique des déclarations de meublé:',
                'attr' => [
                    'placeholder' => "DAVANT",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])            
            ->add('mairie_contact_prenom', TextType::class,  [
                'required' => false,
                'label' => 'Prénom du responsable technique des déclarations de meublé:',
                'attr' => [
                    'placeholder' => "Sacha",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_telephone_contact', TextType::class,  [
                'required' => false,
                'label' => 'Téléphone du responsable technique :',
                'attr' => [
                    'placeholder' => "0102030405",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])            
            ->add('mairie_email_contact', EmailType::class,  [
                'required' => false,
                'label' => 'Email de contact général de la mairie',
                'attr' => [
                    'placeholder' => "davant-sacha@commune.fr",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "email"
                ]
            ])
            ->add('mairie_photo_1', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                'label'         => 'Ajouter des photos de votre maire ou commune',
                'attr'      => [
                    'class'         => "form-control form-control-lg mb-3",
            ]
            ))
            ->add('mairie_photo_2', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                // 'label'         => 'Ajouter une photo principale',
                'attr'      => [
                    'class'         => "form-control form-control-lg mb-3",
            ]
            ))  
            ->add('mairie_photo_3', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                // 'label'         => 'Ajouter une photo principale',
                'attr'      => [
                    'class'         => "form-control form-control-lg mb-3",
            ]
            )) 
            ->add('mairie_photo_4', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                // 'label'         => 'Ajouter une photo principale',
                'attr'      => [
                    'class'         => "form-control form-control-lg mb-3",
            ]
            )) 
            ->add('mairie_taxe_sejour_gestionnaire', TextType::class,  [
                'required' => false,
                'label' => 'Nom de l\'organisme gestionnaire de la taxe de séjour :',
                'attr' => [
                    'placeholder' => "Communauté de communes de ...",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])            
            ->add('mairie_taxe_sejour_bareme', TextType::class,  [
                'required' => false,
                'label' => 'Barême de la taxe de séjour',
                'attr' => [
                    'placeholder' => "faire préciser à Pierre",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('mairie_sejour_lien', TextType::class,  [
                'required' => false,
                'label' => 'Lien du site internet de paiement de la taxe de séjour',
                'attr' => [
                    'placeholder' => "www.",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('mairie_contact_nom_prenom', TextType::class,  [
                'required' => false,
                'label' => 'Nom et prénom de la personne référente de la taxe de séjour',
                'attr' => [
                    'placeholder' => "",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('mairie_de_telephone', TextType::class,  [
                'required' => false,
                'label' => 'Numéro de téléphone pour la taxe de séjour',
                'attr' => [
                    'placeholder' => "03 26 75 41 23",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('mairie_sejour_email', TextType::class,  [
                'required' => false,
                'label' => 'Email de contact pour la taxe de séjour',
                'attr' => [
                    'placeholder' => "contact@taxedesejour-commune.fr",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('mairie_logo', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                'label'         => 'Logo de votre commune',
                'attr'      => [
                    'class'         => "form-control form-control-lg mb-3",
            ]
            )) 
            ->add('mairie_logo_2', FileType::class, array(
                'required'      => null,
                'data_class'    => null,
                'label'         => 'Autre logo',
                'attr'      => [
                    'class'         => "form-control form-control-lg mb-3",
            ]
            )) 
            ->add('mairie_adresse', TextType::class, [
                'required' => true,
                'label' => 'Adresse de la mairie:',
                'attr' => [
                    'placeholder' => "317 chemin des Blés Dorés",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_complement_adresse', TextareaType::class, [
                'required' => false,
                'label' => 'Complément d\'adresse :',
                'attr' => [
                    'placeholder' => "Bât B, étage 2",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "textarea"
                ]
            ])
            ->add('mairie_postal_code', TextType::class, [
                'required' => true,
                'label' => 'Code postal :',
                'attr' => [
                    'placeholder' => "04400",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('mairie_commune', TextType::class,
            [
                'required' => true,
                'label' => 'Commune',
                'attr' => [
                    'placeholder' => "Marseille",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('mairie_telephone_general', TextType::class,  [
                'required' => true,
                'label' => 'Numéro de téléphone de la mairie:',
                'attr' => [
                    'placeholder' => "01 02 03 04 05",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            
            // ->add('mairie_tampon', FileType::class, array(
            //     'required'      => false,
            //     'data_class'    => null,
            //     'label'         => 'Tampon officiel de la Mairie',
            //     'attr'      => [
            //         'class'         => "form-control form-control-lg mb-3",
            // ]
            // )) 
            // ->add('mairie_maire_signature', FileType::class, array(
            //     'required'      => false,
            //     'data_class'    => null,
            //     'label'         => 'Signature manuscrite du Maire de la commune',
            //     'attr'      => [
            //         'class'         => "form-control form-control-lg mb-3",
            // ]
            // )) 
            ->add('insee', TextType::class,  [
                'required' => true,
                'label' => 'Code insee de la commune',
                'attr' => [
                    // 'placeholder' => "",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text",
                    'onkeyup' => "inseeRequest();"
                ]
            ]) 
            ->add('signature', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Allez à l\'étape 2' ,
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
