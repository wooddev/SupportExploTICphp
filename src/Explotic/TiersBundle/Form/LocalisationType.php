<?php

namespace Explotic\TiersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commune')
            ->add('cp')
            ->add('geometry', 'gmaps_picker', array(
                'label'=> 'point',
                'data_class' => 'Explotic\TiersBundle\Entity\Geometry'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\TiersBundle\Entity\Localisation'
        ));
    }

    public function getName()
    {
        return 'explotic_tiersbundle_localisationtype';
    }
}
