<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heb_adresse')
            ->add('heb_adresse_complement')
            ->add('heb_batiment')
            ->add('heb_etage')
            ->add('heb_code_postal')
            ->add('heb_commune')
            ->add('heb_lat')
            ->add('heb_long')
            ->add('heb_type')
            ->add('heb_nbr_pieces')
            ->add('heb_couchages_max')
            ->add('heb_classement')
            ->add('heb_date_classement')
            ->add('heb_periodes_location')
            ->add('heb_date_declaration')
            ->add('heb_numero_enregistrement')
            ->add('heb_descriptif_court')
            ->add('heb_photo_1')
            ->add('heb_photo_2')
            ->add('heb_photo_3')
            ->add('heb_site_web')
            ->add('heb_site_resa')
            ->add('heb_contact_resa')
            ->add('heb_email_resa')
            ->add('heb_tel_resa')
            ->add('heb_date_creation')
            ->add('heb_statut')
            ->add('heb_date_suppression')
            ->add('heb_user')
            ->add('heb_mairie')
            ->add('heb_ot')
            ->add('heb_ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
        ]);
    }
}
