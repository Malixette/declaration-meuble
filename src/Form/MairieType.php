<?php

namespace App\Form;

use App\Entity\Mairie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MairieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mairie_nom_touristique')
            // ->add('mairie_descriptif_1') null
            // ->add('mairie_descriptif_2') null
            // ->add('mairie_epci_rattachement') null
            ->add('mairie_maire_nom')
            ->add('mairie_maire_prenom')
            // ->add('mairie_adjoint_nom') null
            // ->add('mairie_adjoint_prenom') null
            ->add('mairie_contact_nom') 
            ->add('mairie_contact_prenom') 
            ->add('mairie_telephone_contact') 
            ->add('mairie_email_contact') 
            // ->add('mairie_latitude') SETTER
            // ->add('mairie_longitude') SETTER
            // ->add('mairie_photo_1') null
            // ->add('mairie_photo_2') null
            // ->add('mairie_photo_3') null
            // ->add('mairie_photo_4') null
            // ->add('mairie_taxe_sejour_gestionnaire') null
            // ->add('mairie_taxe_sejour_bareme') null
            // ->add('mairie_sejour_lien') null
            // ->add('mairie_contact_nom_prenom') null
            // ->add('mairie_de_telephone') null
            // ->add('mairie_sejour_email') null
            // ->add('mairie_rappel_texte') null
            // ->add('mairie_rappel_lien') null
            // ->add('mairie_logo') null
            // ->add('mairie_logo_2') null
            // ->add('mairie_date_inscription') SETTER
            // ->add('mairie_tampon') null
            // ->add('mairie_maire_signature') null
            // ->add('mairie_slug') SETTER
            // ->add('ville') null
            // ->add('officeTourisme') null
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
            'data_class' => Mairie::class,
        ]);
    }
}
