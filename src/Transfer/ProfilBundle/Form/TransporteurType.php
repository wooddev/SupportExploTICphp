<?php

namespace Transfer\ProfilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransporteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('priorite')
            ->add('quota')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ProfilBundle\Entity\Transporteur'
        ));
    }

    public function getName()
    {
        return 'transfer_profilbundle_transporteurtype';
    }
}
