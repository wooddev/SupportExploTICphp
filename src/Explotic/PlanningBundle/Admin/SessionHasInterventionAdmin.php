<?php
namespace Explotic\PlanningBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of ProfilAdmin
 *
 * @author adarr
 */


class SessionHasInterventionAdmin extends Admin{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
                        
        $listMapper
                ->add('_action', 'actions', array(
                    'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    )
                ));
        $listMapper
                ->addIdentifier('session.numero')
                ->add('session.module.nom')
                ->add('stagiaires')  
                ->add('formateurs')
            ;

    }

    protected function configureDatagridFilters(DatagridMapper $filter) {
        
        $filter
                ->add('session.numero')
                ->add('session.module.nom')
                ->add('interventionHasStagiaires')
                ->add('interventionHasFormateurs')
            ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper                 
                ->add('session.numero')
                ->add('session.module')           
                ->add('interventionHasStagiaires.stagiaire')  
                ->add('interventionHasFormateurs.formateur')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('Stagiaires')                    
                    ->add('interventionHasStagiaires','sonata_type_collection',
                        array(
                            'type_options'=>array('delete'=>true,'btn_delete'=>true,'btn_add'=>true),
                            "required"=>false,
                            "by_reference"=>false,
                            ),                        
                        array(
                            'inline'=>'table',
                            'edit'=>'inline',
                            )
                    )
                ->end()
                ->with('Formateurs')                
                    ->add('interventionHasFormateurs','sonata_type_collection',
                        array(
                            'type_options'=>array('delete'=>true,'btn_delete'=>true,'btn_add'=>true),
                            "required"=>false,
                            "by_reference"=>false,
                            ),                        
                        array(
                            'inline'=>'table',
                            'edit'=>'inline',
                            )
                    )
                ->end()
                 
        ;

    }
    
    public function prePersist($object) {
        foreach($object->getInterventionHasStagiaires() as $interventionHasStagiaire){
            $interventionHasStagiaire->setSessionHasIntervention($object);
        }
        foreach($object->getInterventionHasFormateurs() as $interventionHasFormateur){
            $interventionHasFormateur->setSessionHasIntervention($object);
        }
    }
    
    public function preUpdate($object) {
        foreach($object->getInterventionHasStagiaires() as $interventionHasStagiaire){
            $interventionHasStagiaire->setSessionHasIntervention($object);
        }
        foreach($object->getInterventionHasFormateurs() as $interventionHasFormateur){
            $interventionHasFormateur->setSessionHasIntervention($object);
        }
    }
    
}

?>
