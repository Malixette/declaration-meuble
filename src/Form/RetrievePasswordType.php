<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RetrievePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_email', EmailType::class, [
                'required' => true,
                'label' => 'Entrez l\'adresse mail associée à ce compte pour réinitialiser votre mot de passe :',
                'attr' => [
                    'placeholder' => "votre@email.com",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "email"
                ]
            ])
             ->add('valider', SubmitType::class, [
                'label' => 'Valider',
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
