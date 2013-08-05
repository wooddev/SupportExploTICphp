<?php

namespace Transfer\ProfilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgentDabType extends AbstractType
{
    private $userForm;
    public function __construct($userForm) {
        $this->userForm = $userForm;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $role = 'ROLE_DAB';
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
            'data_class' => 'Transfer\ProfilBundle\Entity\AgentDab'
        ));
    }

    public function getName()
    {
        return 'transfer_profilbundle_agentdabtype';
    }
}
