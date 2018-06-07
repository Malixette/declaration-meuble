<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, [
                'type'      => PasswordType::class,
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
        ]);
    }
}
