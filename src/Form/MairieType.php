<?php

namespace App\Form;

use App\Entity\Mairie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MairieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mairie_nom_touristique')
            ->add('mairie_descriptif_1')
            ->add('mairie_descriptif_2')
            ->add('mairie_epci_rattachement')
            ->add('mairie_maire_nom')
            ->add('mairie_maire_prenom')
            ->add('mairie_adjoint_nom')
            ->add('mairie_adjoint_prenom')
            ->add('mairie_contact_nom')
            ->add('mairie_contact_prenom')
            ->add('mairie_telephone_contact')
            ->add('mairie_email_contact')
            ->add('mairie_latitude')
            ->add('mairie_longitude')
            ->add('mairie_photo_1')
            ->add('mairie_photo_2')
            ->add('mairie_photo_3')
            ->add('mairie_photo_4')
            ->add('mairie_taxe_sejour_gestionnaire')
            ->add('mairie_taxe_sejour_bareme')
            ->add('mairie_sejour_lien')
            ->add('mairie_contact_nom_prenom')
            ->add('mairie_de_telephone')
            ->add('mairie_sejour_email')
            ->add('mairie_rappel_texte')
            ->add('mairie_rappel_lien')
            ->add('mairie_logo')
            ->add('mairie_logo_2')
            ->add('mairie_date_inscription')
            ->add('mairie_tampon')
            ->add('mairie_maire_signature')
            ->add('mairie_slug')
            ->add('ville')
            ->add('officeTourisme')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mairie::class,
        ]);
    }
}
