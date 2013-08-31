<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauModeleRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('jours','choice',array(
                'choices'=>array(
                    '1'=>'Lundi',
                    '2'=>'Mardi',
                    '3'=>'Mercredi',
                    '4'=>'Jeudi',
                    '5'=>'Vendredi',
                    '6'=>'Samedi',
                    ),
                'label'=> 'Jours des créneaux',
                'expanded'=>true,
                'multiple'=>true,
            ))
            ->add('heureDebut','time',array(
                'label'=> '1ère heure de la plage de créneaux (heure de début de créneau)',
                
            ))
            ->add('heureFin','time',array(
                'label'=> 'dernière heure de la plage de créneaux (heure de fin de créneau)',
               
            ))
            ->add('postes','entity',array(
                'class'=>'TransferReservationBundle:TypePoste',
                'label'=>'Poste(s) où seront appliquées les modifcations',
                'expanded'=>true,
                'multiple'=>true,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Recherche\CreneauModeleRecherche'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneaumodelerecherchetype';
    }
}
