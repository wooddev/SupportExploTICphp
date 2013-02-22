<?php

namespace Explotic\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GMapsAddressPickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
               ->add('address', null, array(
                    'required'      => true,
                ))
               ->add('street', null, array(
                    'required'      => true,
                ))                
                ->add('city', null, array(
                    'required'      => false,
                ))
                ->add('postalCode', null, array(
                    'required'      => false,
                ))
                ->add('lat', null, array(
                    'required'      => false
                ))
                ->add('lon', null, array(
                    'required'      => false                                  
            ))
        ;
    }
            
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\TiersBundle\Entity\Bureau'
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
        return 'gmaps_address_picker';
    }
}
