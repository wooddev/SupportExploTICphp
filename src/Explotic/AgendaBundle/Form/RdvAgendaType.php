<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class RdvAgendaType extends AbstractType
{
    
    private $agendas,
            $dateDebut,
            $periode,
            $statusOptions;
    
    public function setAgendas($agendas) {
        $this->agendas = $agendas;
    }
    
    public function init($agendas, $dateDebut,$periode,$statusOptions){
        $this->agendas = $agendas;
        $this->dateDebut = $dateDebut;
        $this->periode = $periode;      
        $this->statusOptions= $statusOptions;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('bookingSelectedOption','choice',array(
            'choices'=>$this->statusOptions,
            'label'=>'Statut des créneaux sélectionnés'
        ));        
                
        if(!(null=== $this->dateDebut)){
            $dateDebut = $this->dateDebut;
            $dateFin = clone $dateDebut;
            $dateFin->add(new \DateInterval('P'.$this->periode.'W'));
            $builder->add('slots','entity',array(
                    'class'=> 'Explotic\AgendaBundle\Entity\CreneauRdv',
                    'expanded'=> true,
                    'multiple'=> true,
                    'attr'=>array('checked'=>false),
                    'label'=>'Choix des créneaux',
                    'query_builder'=> function(\Explotic\AgendaBundle\Entity\CreneauRdvRepository $er) use ($dateDebut,$dateFin)
                    {
                        return $er->createQueryBuilder('c')
                                ->andWhere('c.dateHeureDebut >= :dateDebut')
                                ->andWhere('c.dateHeureFin <= :dateFin')
                                ->setParameters(array(
                                    'dateDebut'=>$dateDebut,
                                    'dateFin'=>$dateFin,
                                ));
                    }
                    ));
        }else{
            $builder->add('slots','entity',array(
                    'class'=> 'Explotic\AgendaBundle\Entity\CreneauRdv',
                    'expanded'=> true,
                    'multiple'=> true,
                    'label'=>'Choix des créneaux',
                    ));
        }
                
        $builder
                ->add('bookingType','text',array(
                    'read_only'=>true,
                    'attr'=>array('class'=>'invisible'),
                ))
                ->add('agenda','entity',array(
                    'class'=>'ExploticAgendaBundle:Agenda',
                    'read_only'=>true,
                    'attr'=>array('class'=>'invisible'),
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Generateurs\BookingGen'
        ));
    }
    
    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options) {
        
        $view->vars['agendas']=$this->agendas;
        parent::buildView($view, $form, $options);        
    }

    public function getName()
    {
        return 'explotic_agendabundle_rdvagendatype';
    }
}
