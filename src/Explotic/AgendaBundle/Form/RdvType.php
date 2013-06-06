<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RdvType extends AbstractType
{
    private $dateDebut;
    private $dateFin;
    private $user;
    
    public function __construct($dateDebut,$dateFin,$user) {
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->user = $user;
        return $this;
    }        
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateDebut = $this->dateDebut;
        $dateFin = $this->dateFin;
        $user = $this->user;
        $builder
            ->add("calendrier","entity",array(
                'class'=>  "ExploticPlanningBundle:Calendrier",
                'query_builder' =>function(\Explotic\PlanningBundle\Entity\CalendrierRepository $er) use ($user){
                    return $er->findAutorises($user);            
                }, 
                'property'=> "nom",
                'multiple'=>false,
                'expanded'=>false,
            ))
            ->add('statutRdv','choice',array(
                'choices'=> array('provisoire'=>'Provisoire','confirme'=>'Confirmé')
            ))
            ->add('creneauRdv',"entity",array(
                'class'=>  "ExploticAgendaBundle:CreneauRdv",
                'query_builder' =>function(\Explotic\AgendaBundle\Entity\CreneauRdvRepository $er)use ($dateDebut,$dateFin){
                    return $er->findByPeriod($dateDebut, $dateFin);            
                },
                'multiple'=> true,
                'expanded'=>true,                        
            ))
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
