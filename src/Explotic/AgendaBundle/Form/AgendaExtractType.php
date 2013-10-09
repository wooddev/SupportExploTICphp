<?php

namespace Explotic\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgendaExtractType extends AbstractType
{ 
    private $agendaList;
    
    public function getAgendaList() {
        return $this->agendaList;
    }

    public function setAgendaList($agendaList) {
        $this->agendaList = $agendaList;
    }

            
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
                ->add('year','number',array(
                    'label'=> 'Année',
                ))
                ->add('week','number',array(
                    'label'=>'Numéro de la 1ère semaine',
                ))
                ->add('duree','number',array(
                    'label'=>'Nombre de semaines affichées',
                ));
        if($this->agendaList){
            $agendaList = $this->agendaList;        
            $builder
                ->add('agendaEntities','entity',array(
                    'class'=>'ExploticAgendaBundle:Agenda',
                    'label'=>'Sélection des agendas',
                    'query_builder'=>function(\Doctrine\ORM\EntityRepository $er) use ($agendaList){                    
                                        $qb=$er->createQueryBuilder('a');
                                        return $qb
                                                ->add('where',$qb->expr()->in('a',$agendaList));
                                    },
                    'multiple'=>true,                
                ))                
            ;
        }else{
            $builder
                ->add('agendaEntities','entity',array(
                    'class'=>'ExploticAgendaBundle:Agenda',
                    'label'=>'Sélection des agendas',
                    'multiple'=>true,                
                ))                
            ;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Explotic\AgendaBundle\Model\AgendaExtractor'
        ));
    }

    public function getName()
    {
        return 'explotic_agendabundle_agendaextracttype';
    }
}
