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
            $periode;
    
    public function setAgendas($agendas) {
        $this->agendas = $agendas;
    }
    
    public function init($agendas, $dateDebut,$periode){
        $this->agendas = $agendas;
        $this->dateDebut = $dateDebut;
        $this->periode = $periode;        
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateDebut = $this->dateDebut;
        $dateFin = clone $dateDebut;
        $dateFin->add(new \DateInterval($this->periode));
        $builder                          
                ->add('slots','entity',array(
                    'class'=> 'Explotic\AgendaBundle\Entity\CreneauRdv',
                    'expanded'=> true,
                    'multiple'=> true,
                    'label'=>'Créneaux disponibles',
                    'query_builder'=> function(\Explotic\AgendaBundle\Entity\CreneauRdvRepository $er) use ($dateDebut,$dateFin)
                    {
                        return $er->createQueryBuilder('cm')
                                ->andwhere('cm.dateHeureDebut >= :dateDebut')
                                ->andwhere('cm.dateHeureFin <= :dateFin')
                                ->setParameters(array(
                                    'dateDebut'=>$dateDebut,
                                    'dateFin'=>$dateFin,
                                ));
                    }
                    ))

        ;
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