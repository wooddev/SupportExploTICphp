<?php

namespace Explotic\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Explotic\TiersBundle\Form\DataTransformer\BureauToGMapsAddressTransformer;

class GMapsAddressPickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $transformer = new BureauToGMapsAddressTransformer();
        $builder
                ->add('streetNumber', null, array(
                    'required'      => false,
                    'attr'=>array('data-geo'=>'street_number')
                ))
                ->add('route', null, array(
                    'required'      => false,
                    'attr'=>array('data-geo'=>'route')
                ))
                ->add('city', null, array(
                    'required'      => false,
                    'attr'=>array('data-geo'=>'locality')
                ))
                ->add('postalCode', null, array(
                    'required'      => false,
                    'attr'=>array('data-geo'=>'postal_code')
                ))
                ->add('lat', null, array(
                    'required'      => false,
                    'attr'=>array('data-geo'=>'lat')
                ))
                ->add('lon', null, array(
                    'required'      => false    ,
                    'attr'=>array('data-geo'=>'lng')              
                ))
                ;
        $builder->addModelTransformer($transformer);
        
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
        return 'gmaps_address_picker';
    }
}
