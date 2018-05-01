<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => "votre@email.com",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "email"
                ]
            ])
            ->add('password', PasswordType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => "Mot de passe",
                    'class' => "form-control form-control mb-3",
                    'type' => "password"
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
