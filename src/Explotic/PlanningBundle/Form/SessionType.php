<?php

namespace Explotic\PlanningBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('calendrier')
            ->add('siteIntervention')
            ->add('intervention')
            ->add('stagiaires')
            ->add('formateurs')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\PlanningBundle\Entity\Session'
        ));
    }

    public function getName()
    {
        return 'explotic_planningbundle_sessiontype';
    }
}
