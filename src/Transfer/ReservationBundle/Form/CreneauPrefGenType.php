<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CreneauPrefGenType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
                ->add('transporteur')              
                ->add('creneauModele','entity',array(
                    'expanded'=> true,
                    'multiple'=> true,
                    ))
                ->add('etatReservation',"hidden")
                ->add('statut',"hidden")
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Generateurs\CreneauPrefGen'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneaupreftype';
    }
}
