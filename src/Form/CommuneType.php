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



class CommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,  [
                'required' => true,
                'label' => 'Nom d\'utilisateur :',
                'attr' => [
                    'placeholder' => "MairieBarcelonnette",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_adresse', TextType::class, [
                'required' => false,
                'label' => 'Adresse :',
                'attr' => [
                    'placeholder' => "317 chemin des Blés Dorés",
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
            // ->add('user_postal_code', TextType::class, [
            //     'required' => false,
            //     'label' => 'Code postal :',
            //     'attr' => [
            //         'placeholder' => "04400",
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "text"
            //     ]
            // // ]) 
            // ->add('user_commune', TextType::class,
            // [
            //     'required' => false,
            //     'label' => 'Nom de la commune :',
            //     'attr' => [
            //         'placeholder' => "Barcelonnette",
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "text"
            //     ]
            // ])

            // ->add('user_telephone', IntegerType::class, [
            //     'required' => false,
            //     'label' => 'N° de téléphone de la mairie :',
            //     'attr' => [
            //         'placeholder' => "061122334455",
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "text"
            //     ]
            // // ])
            // ->add('user_email', EmailType::class, [
            //     'required' => true,
            //     'label' => 'Email de contact (pour vos administrés):',
            //     'attr' => [
            //         'placeholder' => "barcelonnette-declaration@mairie.fr",
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "email"
            //     ]
            // ])
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
            'data_class' => User::class,
        ]);
    }
}