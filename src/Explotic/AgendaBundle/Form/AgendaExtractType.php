<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgendaExtractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('year','number',array(
                    'label'=> 'Année',
                ))
                ->add('week','number',array(
                    'label'=>'Numéro de la 1ère semaine',
                ))
                ->add('duree','number',array(
                    'label'=>'Nombre de semaines affichées',
                ))
                ->add('agendaEntity','entity',array(
                    'class'=>'ExploticAgendaBundle:Agenda',
                    'label'=>'Numéro de l\'agenda',
                    'read_only'=>true,
                ))                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Model\AgendaExtractor'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_agendaextracttype';
    }
}
