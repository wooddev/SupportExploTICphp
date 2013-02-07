<?php

namespace Explotic\PlanningBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreditTempsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tempsTotal')
            ->add('tempsReserve')
            ->add('tempsConsomme')
            ->add('tempsDisponible')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\PlanningBundle\Entity\CreditTemps'
        ));
    }

    public function getName()
    {
        return 'explotic_planningbundle_credittempstype';
    }
}
