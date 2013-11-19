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


class SessionAdmin extends Admin{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
                ->addIdentifier('numero')  
                ->add('dateDebut')
                ->add('module.nom')
            ;
    }



    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('numero')
                ->add('dateDebut')
                ->add('module.nom')
                ->add('sessionHasInterventionSalles.intervention')
                ->add('sessionHasInterventionEntreprises.intervention')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('Généralités')
                    ->add("numero")
                    ->add('dateDebut')
                    ->add('module','entity',array(
                        'class'=>'Explotic\FormationBundle\Entity\Module',
                    ))
                ->end()
                ->with('Interventions en salle')
                    ->add('sessionHasInterventionSalles','sonata_type_collection',
                        array(
                            'type_options'=>array('delete'=>true,'btn_delete'=>true,'btn_add'=>true),
                            "required"=>false,
                            "by_reference"=>true,
                            ),
                        array(
                            'inline'=>'standard',
                            'edit'=>'standard',
                            )
                    )
                ->end()
                ->with('Interventions en entreprise')
                    ->add('sessionHasInterventionEntreprises','sonata_type_collection',
                        array(
                            'type_options'=>array('delete'=>true,'btn_delete'=>true,'btn_add'=>true),
                            "required"=>false,
                            "by_reference"=>true,
                            ),
                        array(
                            'inline'=>'standard',
                            'edit'=>'standard',
                            )
                    )
                ->end()
                 
        ;

    }
    
    
    public function prePersist($object) {
        foreach($object->getSessionHasInterventionEntreprises() as $intervention){
            $intervention->setSession($object);
        }
        foreach($object->getSessionHasInterventionSalles() as $intervention){
            $intervention->setSession($object);
        }
        
    }
    
    public function preUpdate($object) {
        foreach($object->getSessionHasInterventionEntreprises() as $intervention){
            $intervention->setSession($object);
        }
        foreach($object->getSessionHasInterventionSalles() as $intervention){
            $intervention->setSession($object);
        }
    }
    
}

?>
