<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SelectTypeCamionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeCamion','entity',array(
                'class'=>'Transfer\ReservationBundle\Entity\TypeCamion',
                'label'=>'Type de camion affecté à la réservation',
                'property'=>'nom',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Generateurs\TypeCamionSelector'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_selecttypecamiontype';
    }
}
