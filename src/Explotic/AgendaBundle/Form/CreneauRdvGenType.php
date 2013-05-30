<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauRdvGenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add("dateDebut","date",array(
                    'label'=> "date de début",
                    'widget'=>'choice'
                ))
                ->add("dateFin","date",array(
                    'label'=> "date de fin",
                    'widget'=>'choice'
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Generateurs\CreneauRdvGen'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_creneaurdvgentype';
    }
}
