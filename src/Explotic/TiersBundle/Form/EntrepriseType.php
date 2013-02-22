<?php

namespace Explotic\TiersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Explotic\TiersBundle\Form\DataTransformer\BureauToGMapsAddressTransformer;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new BureauToGMapsAddressTransformer();
        $builder
            ->add('raisonSociale')
            ->add('telephone')
            ->add('siret')
            ->add('ape')
            ->add('cnil')
            ->add('versionExplotic')
            ->add('email')
            ->add('commentaires')
//            ->add('bureau', new BureauType())
            
//            ->add(
//                    'bureau', 'gmaps_address_picker')
//                        ->addModelTransformer($transformer)
                    
            ->add(
                    $builder->create('bureau', 'gmaps_address_picker')->addModelTransformer($transformer)
                    )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\TiersBundle\Entity\Entreprise'
        ));
    }

    public function getName()
    {
        return 'explotic_tiersbundle_entreprisetype';
    }
}
