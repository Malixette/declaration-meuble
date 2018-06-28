<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Mairie;



class ChoixCommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commune', EntityType::class,  [
                'class' => Mairie::class,
                'choice_label' => 'mairie_nom_touristique',
                'placeholder' => 'Choisissez une commune...',
                'required' => false,
                'label' => 'Nom de la commune :',
                'attr' => [
                    'placeholder' => "Barcelonnette",
                    'class' => "form-control form-control-lg mb-3",
                    'type' => "text",
                    'onchange' => 'this.form.submit()'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
