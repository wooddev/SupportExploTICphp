<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CreneauPrefGenType extends AbstractType
{
    
    private $agendas;
    
    public function setAgendas($agendas) {
        $this->agendas = $agendas;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
                ->add('transporteur','entity', array(
                    'class'=>'Transfer\ProfilBundle\Entity\Transporteur'
                ))
                ->add('typeCamion','entity',array(
                    'class'=>'Transfer\ReservationBundle\Entity\TypeCamion',
                    'read_only'=>true,
//                    'disabled'=>true,
                    ))            
//                ->add('etatReservation',"entity",array(
//                    'class'=>'Transfer\ReservationBundle\Entity\EtatReservation',
//                    'read_only'=> true,
//                    'disabled'=>true,
//                ))
//                ->add('statut',"entity",array(
//                    'class'=>'Transfer\ReservationBundle\Entity\StatutCreneau',
//                    'read_only'=> true,
//                    'disabled'=>true,
//                ))
                ->add('creneauxModeles','entity',array(
                    'class'=> 'Transfer\ReservationBundle\Entity\CreneauModele',
                    'expanded'=> true,
                    'multiple'=> true,
                    'label'=>'Créneaux disponibles'
                    ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Generateurs\CreneauPrefGen'
        ));
    }
    
    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options) {
        
        $view->vars['agendas']=$this->agendas;
        parent::buildView($view, $form, $options);        
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneauprefgentype';
    }
}
