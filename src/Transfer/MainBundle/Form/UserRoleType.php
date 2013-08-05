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
                'choices'=>array('ROLE_DAB'=>'DAB','ROLE_TRANSPORTEUR'=>'Transporteur','ROLE_ADMIN'=>'Admin','ROLE_RECEP'=>'Réception'),
                'multiple'=>true,
                'expanded'=>true,
                'preferred_choices'=>array('ROLE_TRANSPORTEUR'),
                
            ))
            ->add('Profil','entity',array(
                'class'=>'TransferProfilBundle:Profil',
            ))
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
