<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Votre nom :',
                'attr' => [
                    'placeholder' => "Julie Pajon",
                    'class' => "form-control form-control-lg"
                    ]
                ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email :',
                'attr' => [
                    'placeholder' => "votre@email.com",
                    'class' => "form-control form-control-lg",
                    'type' => "email"
                ]
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => 'Objet :',
                'attr' => [
                    'placeholder' => "Informations sur la déclaration de meublé",
                    'class' => "form-control form-control-lg"
                    ]
                ])
            ->add('message' , TextareaType::class, [
                'required' => false,
                'label' => 'Message :',
                'attr' => [
                    'placeholder' => "Votre demande ici...",
                    'class' => "form-control form-control-lg",
                    'type' => "textarea"
                ]
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-lg btn-success'    
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
