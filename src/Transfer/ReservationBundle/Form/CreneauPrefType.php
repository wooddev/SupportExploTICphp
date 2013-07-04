<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CreneauPrefType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('creneauModele')
            ->add('creneauModele','entity',array(
                'class' => 'TransferReservationBundle:CreneauModele',
                'query_builder' => function(EntityRepository $er){
                                return $er->findDisponibles();            
                        }, 
                'expanded'=> true,
                'multiple'=> true,
            ))
            ->add('transporteur')
            ->add('etatReservation')
            ->add('statut')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Entity\CreneauPref'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneaupreftype';
    }
}
