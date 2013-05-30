<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("calendrier")
            ->add('statutRdv','choice',array(
                'choices'=> array('provisoire'=>'Provisoire','confirme'=>'Confirmé','annule' => 'annulé')
            ))
            ->add('creneauRdv')
            ->add('type')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Entity\Rdv'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_rdvtype';
    }
}
