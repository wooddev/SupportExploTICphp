<?php

namespace Explotic\FormationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgrammeType extends AbstractType
{
       
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accompagnement','choice',array(
                'choices' => array(
                    'nonRealise'=> 'Non réalisé',
                    'enCours' => 'En cours',
                    'realise' => 'Réalisé',)
                ))
            ->add('FormationSalle','choice',array(
                'choices' => array(
                    'nonRealise'=> 'Non réalisé',
                    'enCours' => 'En cours',
                    'realise' => 'Réalisé',)
                ))
            ->add('module')
            ->add('stagiaire', 'entity', array(
                    'class' => 'ExploticTiersBundle:Stagiaire',
            ));
            
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\FormationBundle\Entity\Programme'
        ));
    }

    public function getName()
    {
        return 'explotic_formationbundle_programmetype';
    }
}
