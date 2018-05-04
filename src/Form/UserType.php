<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Mairie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_nom', TextType::class,  [
                'required' => true,
                'label' => 'Nom :',
                'attr' => [
                    'placeholder' => "Dupont",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('username', TextType::class,  [
                'required' => true,
                'label' => 'Nom d\'utilisateur :',
                'attr' => [
                    'placeholder' => "SuperSlip",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_prenom', TextType::class, [
                'required' => true,
                'label' => 'Prénom :',
                'attr' => [
                    'placeholder' => "Géraldine",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_adresse', TextType::class, [
                'required' => false,
                'label' => 'Adresse :',
                'attr' => [
                    'placeholder' => "317 rue des pieds paquets",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_complement_adresse', TextareaType::class, [
                'required' => false,
                'label' => 'Complément d\'adresse :',
                'attr' => [
                    'placeholder' => "Bât B, étage 2",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "textarea"
                ]
            ])
            ->add('user_postal_code', TextType::class, [
                'required' => false,
                'label' => 'Code postal :',
                'attr' => [
                    'placeholder' => "04400",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('user_commune', TextType::class,
            [
                'required' => false,
                'label' => 'Commune de résidence :',
                'attr' => [
                    'placeholder' => "Barcelonnette",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_pays', CountryType::class,
                [
                'label' => 'Pays de résidence :',
                'preferred_choices' => [
                    'FR', 'CA', 'BE', 'LU', 'CH'
                ],
                'required' => false,
                'attr' => [
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "select"
                    ]   
            ])
            ->add('user_telephone', IntegerType::class, [
                'required' => false,
                'label' => 'N° de téléphone :',
                'attr' => [
                    'placeholder' => "061122334455",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_email', EmailType::class, [
                'required' => true,
                'label' => 'Email :',
                'attr' => [
                    'placeholder' => "votre@email.com",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "email"
                ]
            ])
            // ->add('user_date_inscription', DateTimeType::class)
            
            // ->add('user_role', ChoiceType::class, [
            //     'choices' => [
            //         'Propiétaire' => '2',
            //         'Office de tourisme' => '3',
            //         'Mairie' => '4'
            //         ],
            //     'attr' => [
            //         'class' => "form-control form-control mb-3",
            //         'type' => "select"
            //     ]
            // ])
            // ->add('mairie', EntityType::class, [
            //     'class' => Mairie::class,
            //     'choice_label' => 'id'
            //     ]
            // )
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe entrés sont différents',
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe :',
                    'attr' => [
                        'class'=> 'form-control form-control mb-3'
                    ]
                ],
                'second_options' => [
                    'label' => 'Vérifiez le mot de passe :',
                    'attr' => [
                        'class'=> 'form-control form-control mb-3'
                    ]
                ]
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-lg btn-success'    
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}