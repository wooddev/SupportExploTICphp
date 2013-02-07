<?php

namespace Explotic\FormationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InterventionEntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('dureeJour')
            ->add('stade')
            ->add('module')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\FormationBundle\Entity\InterventionEntreprise'
        ));
    }

    public function getName()
    {
        return 'explotic_formationbundle_interventionentreprisetype';
    }
}
