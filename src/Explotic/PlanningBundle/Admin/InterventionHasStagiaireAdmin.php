<?php
namespace Explotic\PlanningBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of InterventionHasStagiaireAdmin
 *
 * @author adarr
 */


class InterventionHasStagiaireAdmin extends Admin{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
                ->add('stagiaire')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter) {
        
        $filter
                ->add('stagiaire')
            ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper                 
                ->add('stagiaire')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper            
                ->add('stagiaire','sonata_type_model_list')                   
        ;
    }
    
    public function prePersist($object) {
        $object->getStagiaire()->addInterventionHasStagiaire($object);
    }
    
    public function preUpdate($object) {
        $object->getStagiaire()->addInterventionHasStagiaire($object);
    }
    
}

?>
