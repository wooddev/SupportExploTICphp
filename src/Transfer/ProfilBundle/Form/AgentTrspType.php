<?php

namespace Transfer\ProfilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgentTrspType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('courriel')
            ->add('telephone')
            ->add('dateEnregistrement')
//            ->add('transporteur','entity',array(
//                'class'=>'TransferProfilBundle:Transporteur',
//                'property' => 'nom'))
            ->add('transporteur',null,array(
                'required'=>true,
                'empty_value'=>'choisir un transporteur'
                
            ))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ProfilBundle\Entity\AgentTrsp'
        ));
    }

    public function getName()
    {
        return 'transfer_profilbundle_agenttrsptype';
    }
}
