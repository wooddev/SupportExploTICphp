<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauRdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour')
            ->add('heure')
            ->add('minute')
            ->add('duree')
            ->add('heureDebut')
            ->add('heureFin')
            ->add('disponibiliteTotale')
            ->add('semaine')
            ->add('annee')
            ->add('typePoste')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Entity\CreneauRdv'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneaurdvtype';
    }
}
