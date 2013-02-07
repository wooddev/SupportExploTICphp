<?php

namespace Explotic\TiersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance','date',array(
                    'input'=> 'datetime',
                    'widget'=>'choice',
                    'format'=>'dd-MM-yyyy',
                    'years'=>range(1910,2010),
                    'label'=>'Date de naissance',
                    ))
            ->add('marchePiedInfo','checkbox',array('required' => false))
            ->add('telephone','text',array('required' => false))
            ->add('opca','choice',array(
                'choices'=> array('VIVEA'=>'VIVEA','FAFSEA'=>'FAFSEA','OPCA3+'=>'OPCA3+'),
                'required'=> false,
            ))
            ->add('entreprise')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\TiersBundle\Entity\Stagiaire'
        ));
    }

    public function getName()
    {
        return 'explotic_tiersbundle_stagiairetype';
    }
}
