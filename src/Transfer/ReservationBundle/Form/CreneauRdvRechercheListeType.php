<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauRdvRechercheListeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('DateHeureDebut','date',array(
                'label'=> 'Date de début',
                'format'=> 'dd-MM-yyyy',
                'widget'=>'single_text',
            ))
            ->add('DateHeureFin','date',array(
                'label'=> 'Date de fin',
                'format'=> 'dd-MM-yyyy',
                'widget'=>'single_text',
            ))
            ->add('heureDebut','time',array(
                'label'=> '1ère heure de la plage de créneaux (heure de début de créneau)',
                
            ))
            ->add('heureFin','time',array(
                'label'=> 'dernière heure de la plage de créneaux (heure de fin de créneau)',
               
            ))
//            ->add('semaine')
//            ->add('annee')
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
