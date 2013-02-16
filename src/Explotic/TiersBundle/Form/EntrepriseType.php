<?php

namespace Explotic\TiersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('raisonSociale')
            ->add('telephone')
            ->add('siret')
            ->add('ape')
            ->add('cnil')
            ->add('versionExplotic')
            ->add('email')
            ->add('commentaires')
            ->add('bureau', new BureauType())
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