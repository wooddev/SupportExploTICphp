<?php

namespace Transfer\ProfilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgentReceptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $role='ROLE_RECEP';
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('courriel')
            ->add('telephone')
            ->add('user','entity',array(
                'class'=> "TransferMainBundle:User",
                'query_builder'=>function(\Doctrine\ORM\EntityRepository $er) use ($role){
                        return $er->findRoleLike($role);
                    },
                ))
            ;
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ProfilBundle\Entity\AgentReception'
        ));
    }

    public function getName()
    {
        return 'transfer_profilbundle_agentreceptiontype';
    }
}
