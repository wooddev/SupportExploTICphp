<?php

namespace Transfer\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statutRdv')
            ->add('creneauRdv')
            ->add('transporteurPlanif')
            ->add('poste')
            ->add('planningConfirm')
            ->add('planningProvisoire')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Transfer\ReservationBundle\Entity\Rdv'
        ));
    }

    public function getName()
    {
        return 'transfer_reservationbundle_rdvtype';
    }
}
