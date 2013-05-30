<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauRdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour')
            ->add('heure')
            ->add('minute')
            ->add('duree')
            ->add('heureDebut')
            ->add('heureFin')
            ->add('semaine')
            ->add('annee')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Entity\CreneauRdv'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_creneaurdvtype';
    }
}
