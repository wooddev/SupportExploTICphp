<?php

namespace Explotic\AgendaBundle\Form;

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
                'label'=>'Heure de début de créneau',
                
            ))
            ->add('minDebut','number',array(
                'precision'=>0,
                'label'=>'minutes'
            ))
            ->add('heureFin','number',array(
                'precision'=>0,
                'label'=>'Heure de fin de créneau'
            ))
            ->add('minfin','number',array(
                'precision'=>0,
                'label'=>'minutes'
            ))
            ->add('pasDeTemps','number',array(
                'precision'=>0,
                'label'=>'durée d\'un créneau'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Generateurs\CreneauModeleGen'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_creneaumodelegentype';
    }
}
