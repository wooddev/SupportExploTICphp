<?php

namespace Explotic\TiersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroEntreprise')
            ->add('reference')
            ->add('modele')
            ->add('marque')
            ->add('logiciel')
            ->add('transfertData')
            ->add('forfait')
            ->add('commentaire')
            ->add('email')
            ->add('entreprise')            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\TiersBundle\Entity\Machine'
        ));
    }

    public function getName()
    {
        return 'explotic_tiersbundle_machinetype';
    }
}
