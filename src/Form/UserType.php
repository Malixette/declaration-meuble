<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_nom', TextType::class,  [
                'required' => true,
                'attr' => [
                    'placeholder' => "Votre nom",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_prenom', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => "Votre prénom",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_adresse', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "Votre adresse",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_complement_adresse', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "Complément d'adresse",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "textarea"
                ]
            ])
            ->add('user_postal_code', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "Code postal",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ]) 
            ->add('user_commune', TextType::class,
            [
                'required' => false,
                'attr' => [
                    'placeholder' => "Ville de résidence",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_pays', CountryType::class,
                [
                'required' => false,
                'attr' => [
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "select"
                    ]   
            ])
            ->add('user_telephone', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "061122334455",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            ->add('user_email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => "votre@email.com",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "email"
                ]
            ])
            ->add('user_date_inscription', DateTimeType::class)
            ->add('user_role', EntityType::class, [
                'required' => true,
                'class' => User::class,
                'choice_label'=>'user_role',
                'attr' => [
                    'class' => "form-control form-control mb-3",
                    'type' => "select"
                ]
            ])
            ->add('mairie', TextType::class)
            ->add('password', PasswordType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => "Mot de passe",
                    'class' => "form-control form-control mb-3",
                    'type' => "password"
                    
                ]
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-lg btn-success'    
                ]
            ])
            ->add('connecter', SubmitType::class, [
                'label' => 'Se connecter',
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


// ->add('user_pays', CountryType::class, array(
//                 'preferred_choices' => 'france'),
//                 [
//                 'required' => false,
//                 'attr' => [
//                     'class' => "form-control"
//                     ]   
//             ])