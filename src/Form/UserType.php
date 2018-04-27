<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_nom')
            ->add('user_prenom')
            ->add('user_adresse')
            ->add('user_complement_adresse', TextareaType::class)
            ->add('user_postal_code')
            ->add('user_commune')
            ->add('user_pays')
            ->add('user_telephone')
            ->add('user_email')
            ->add('user_date_inscription')
            ->add('user_role')
            ->add('mairie')
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
