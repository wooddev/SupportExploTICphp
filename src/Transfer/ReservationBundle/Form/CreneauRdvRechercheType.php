<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauRdvRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee','hidden')
            ->add('semaine','hidden')
            ->add('typePoste',null,array(
                'label'=>'Type de camion',
            ))                
            ->add('jour','choice',array(
                'choices'=> array(
                                1=>'Lundi',
                                2=>'Mardi',
                                3=>'Mercredi',
                                4=>'Jeudi',
                                5=>'Vendredi',
                                6=>'Samedi',
                                )
            ))
            ->add('heure')
            ->add('minute')
            
//            ->add('duree' , 'hidden')
//            ->add('heureDebut' , 'hidden')
//            ->add('heureFin' , 'hidden')                
//            ->add('disponibilite' , 'hidden')
           
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
        return 'transfer_reservationbundle_creneaurdvrecherchetype';
    }
}
