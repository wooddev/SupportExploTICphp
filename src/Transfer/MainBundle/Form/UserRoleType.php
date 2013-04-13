<?php

namespace Transfer\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')            
            ->add('email')
            ->add('roles', 'choice', array(
                'choices'=>array('DAB'=>'ROLE_DAB','Transporteur'=>'ROLE_TRANSPORTEUR','Admin'=>'ROLE_ADMIN'),
                'multiple'=>true,
                'expanded'=>true,
            ))
            ->add('agentDab')
            ->add('agentTrsp')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\MainBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'transfer_mainbundle_usertype';
    }
}
