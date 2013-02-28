<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreneauRdvGenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('week','integer',array(
                    'label'=>'Numéro de semaine'
                ))
                ->add('year','integer',array(
                    'label'=> 'année'
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Generateurs\CreneauRdvGen'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_creneaurdvgentype';
    }
}
