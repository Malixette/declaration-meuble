<?php

namespace App\Form;

use App\Entity\InfosComplementaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class InfosComplementairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
            'required'  => true,
                'label'     => "Objet de la demande",
                'attr'      => [
                    'placeholder'   => "Ex: merci de nous contacter pour compléter votre demande",
                    'class'         => "input"
                ]    
            ])
            ->add('content', TextareaType::class, [            
                'required'  => true,
                'label'     => "Votre message",
                'attr'      => [
                    'placeholder' => "Renseignez les détails de votre demande",
                    'class' => "textarea",
                    'cols'  => '50', 
                    'rows'  => '3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfosComplementaires::class,
        ]);
    }
}
