<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RdvSelectorType extends AbstractType
{    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add("agenda","entity",array(
                'class'=>'Explotic\AgendaBundle\Entity\Agenda',
                'label'=>'Sélection de l\'agenda où les dates seront bloquées',
            ))                
            ->add('bookingType','text')
            ->add('dateDebut','date')
            ->add('period','integer',array(
                'label'=>'Nombre de semaines à afficher'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Model\RdvSelector'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_rdvsrelectotype';
    }



}
