<?php

namespace Explotic\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('username',null,array(
//                'required'=> false,
//            ))
//            ->add('usernameCanonical',null,array(
//                'required'=> false,
//            ))
//            ->add('email',null,array(
//                'required'=> false,
//            ))
//            ->add('emailCanonical',null,array(
//                'required'=> false,
//            ))
//            ->add('enabled',null,array(
//                'required'=> false,
//            ))
////            ->add('salt','hidden')
//            ->add('password',null,array(
//                'required'=> false,
//            ))
//            ->add('lastLogin',null,array(
//                'required'=> false,
//            ))
//            ->add('locked',null,array(
//                'required'=> false,
//            ))
//            ->add('expired',null,array(
//                'required'=> false,
//            ))
////            ->add('expiresAt','hidden')
//            ->add('confirmationToken',null,array(
//                'required'=> false,
//            ))
//            ->add('passwordRequestedAt',null,array(
//                'required'=> false,
//            ))
//            ->add('credentialsExpired',null,array(
//                'required'=> false,
//            ))
//            ->add('credentialsExpireAt','hidden')
            ->add('roles', 'choice',array(
                'choices' => array(
                    'ROLE_STAGIAIRE'=> 'Stagiaire',
                    'ROLE_RECRUTEUR'=> 'Recruteur',
                    'ROLE_GERANT'=> 'Gérant',
                    'ROLE_FORMATEUR'=> 'Formateur',
                    'ROLE_ADMIN'=> 'Administateur',
                    ),
                'required'=> false,
                'multiple'=>true,
                'expanded'=>true,                
            ))
//            ->add('entreprise', 'entity',array(
//                'class'=> 'ExploticTiersBundle:Entreprise',
//                'property'=>'raisonsociale',
//                'required'=>false ,
//                'empty_value'=>'',
//                
//            ))
//            ->add('recruteur', 'entity',array(
//                'class'=> 'ExploticTiersBundle:Recruteur',
//                'property'=>'nom',
//                'required'=>false,
//                'empty_value'=>'',
//            ))
//            ->add('stagiaire', 'entity',array(
//                'class'=> 'ExploticTiersBundle:Stagiaire',
//                'property'=>'nom',
//                'required'=>false,
//                'empty_value'=>'',
//            ))
//            ->add('formateur', 'entity',array(
//                'class'=> 'ExploticTiersBundle:Formateur',
//                'property'=>'nom',
//                'required'=>false,
//                'empty_value'=>'',
//            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AdminBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'explotic_adminbundle_usertype';
    }
}
