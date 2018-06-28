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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;



class CreationMairieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_email', TextType::class,  [
                'required' => true,
                'label' => 'Adresse email de connexion :',
                'attr' => [
                    'placeholder' => "contact@monemail.fr",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text"
                ]
            ])
            // ->add('user_telephone', TextType::class, [
            //     'required' => true,
            //     'label' => 'N° de téléphone de la mairie :',
            //     'attr' => [
            //         'placeholder' => "04 05 06 07 08",
            //         'class' => "form-control form-control-lg mb-3",
            //         'type' => "text"
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
            // ->add('mairie', HiddenType::class)
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