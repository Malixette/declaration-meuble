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
                'disabled'  => $options['is_forgot'],
                'required' => true,
                'label' => 'Nom du propriétaire ou personne morale :',
                'attr' => [
                    'placeholder' => "Dupont",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            // ->add('username', TextType::class,  [
            //     'disabled'  => $options['is_forgot'],
            //     'required' => true,
            //     'label' => 'Nom d\'utilisateur :',
            //     'attr' => [
            //         'placeholder' => "GeraldineDupont93",
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "text"
            //     ]
            // ])
            ->add('user_prenom', TextType::class, [
                'disabled'  => $options['is_forgot'],
                'required' => true,
                'label' => 'Prénom :',
                'attr' => [
                    'placeholder' => "Géraldine",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_adresse', TextType::class, [
                'disabled'  => $options['is_forgot'],
                'required' => true,
                'label' => 'Adresse de contact:',
                'attr' => [
                    'placeholder' => "317 chemin des Blés Dorés",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_complement_adresse', TextareaType::class, [
                'disabled'  => $options['is_forgot'],
                'required' => false,
                'label' => 'Complément d\'adresse :',
                'attr' => [
                    'placeholder' => "Bât B, étage 2",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "textarea"
                ]
            ])
            ->add('user_postal_code', TextType::class, [
                'disabled'  => $options['is_forgot'],
                'required' => true,
                'label' => 'Code postal :',
                'attr' => [
                    'placeholder' => "04400",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('user_commune', TextType::class,
            [
                'disabled'  => $options['is_forgot'],
                'required' => true,
                'label' => 'Commune de résidence :',
                'attr' => [
                    'placeholder' => "Barcelonnette",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            // ->add('user_pays', CountryType::class,
            //     [
            //     'label' => 'Pays de résidence :',
            //     'preferred_choices' => [
            //         'FR', 'CA', 'BE', 'LU', 'CH'
            //     ],
            //     'required' => false,
            //     'attr' => [
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "select"
            //         ]   
            // ])
            ->add('user_pays', TextType::class, [
                'disabled'  => $options['is_forgot'],
                'required'  => true,
                'label'     => "Pays",
                'attr'      => [
                    'placeholder'   => "Nom du pays de résidence",
                    'class'         => "form-control form-control-lg mb-3",
                    'id'            => "country",
                ]    
            ])
            ->add('user_telephone', TextType::class, [
                'disabled'  => $options['is_forgot'],
                'required' => false,
                'label' => 'N° de téléphone :',
                'attr' => [
                    'placeholder' => "0611223344",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_email', EmailType::class, [
                'disabled'  => $options['is_forgot'],
                'required' => true,
                'label' => 'Email :',
                'attr' => [
                    'placeholder' => "votre@email.com",
                    'class' => "form-control form-control-lg",
                    'type' => "email"
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'      => PasswordType::class,
                'disabled'  => $options['is_edit'],
                'invalid_message' => 'Les mots de passe entrés sont différents',
                'required'  => true,
                'first_options'  => [
                    'label' => 'Mot de passe :',
                    'attr'  => [
                        'class'=> 'form-control form-control mb-3'
                    ]
                ],
                'second_options' => [
                    'label' => 'Vérifiez le mot de passe :',
                    'attr'  => [
                        'class'=> 'form-control form-control mb-3'
                    ]
                ]
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Enregistrer',
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
            'is_edit'    => false,
            'is_forgot' => false,
        ]);
    }
}