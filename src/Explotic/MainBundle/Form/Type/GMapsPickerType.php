<?php

namespace Explotic\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GMapsPickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
                ->add('lat', 'text', array(
                    'required'      => false
                ))
                ->add('lon', 'text', array(
                    'required'      => false
                ))
        ;
    }
            
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\MainBundle\Model\GMapsAddress'
        ));
    }
    public function getDefaultOptions(array $options)
    {
        return array(
            'virtual' => true,
        );
    }

    public function getParent()
    {
        return 'form';
    }
    public function getName()
    {
        return 'gmaps_picker';
    }
}
