<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauModeleGenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heureDebut','number',array(
                'precision'=>0,
                'label'=>'Heure de début de journée',
                
            ))
            ->add('minDebut','number',array(
                'precision'=>0,
                'label'=>'minutes'
            ))
            ->add('heureFin','number',array(
                'precision'=>0,
                'label'=>'Heure de fin de journée'
            ))
            ->add('minfin','number',array(
                'precision'=>0,
                'label'=>'minutes'
            ))
            ->add('pasDeTemps','number',array(
                'precision'=>0,
                'label'=>'durée d\'un créneau'
            ))
            ->add('disponibiliteTotale','number',array(
                'precision'=>0,
                'label'=>'Nombre de camions autorisés par créneau'
            ))
            ->add('typePoste','entity',array(
                'class'=>'Transfer\ReservationBundle\Entity\TypePoste',
                'property'=>'nom'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Generateurs\CreneauModeleGen'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneaumodelegentype';
    }
}
