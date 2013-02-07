<?php

namespace Explotic\FormationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgrammeType extends AbstractType
{
    private $disabledField; //bool
    
    public function __construct($_disabledField){
        $this->setDisabledField($_disabledField);
    }

    public function setDisabledField($disabledField)
    {
        $this->disabledField = $disabledField;
        return $this;
    }

    public function getDisabledField()
    {
        return $this->disabledField;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accompagnement','choice',array(
                'choices' => array(
                    'nonRealise'=> 'Non réalisé',
                    'enCours' => 'En cours',
                    'realise' => 'Réalisé',)
                ))
            ->add('FormationSalle','choice',array(
                'choices' => array(
                    'nonRealise'=> 'Non réalisé',
                    'enCours' => 'En cours',
                    'realise' => 'Réalisé',)
                ))
            ->add('module')
            ->add('stagiaire', 'entity', array(
                    'class' => 'ExploticTiersBundle:Stagiaire',
                    'read_only' => true,// Définit par le controller
                    //'disabled' => $this->getDisabledField(),// Définit par le controller
            ));
            
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\FormationBundle\Entity\Programme'
        ));
    }

    public function getName()
    {
        return 'explotic_formationbundle_programmetype';
    }
}
