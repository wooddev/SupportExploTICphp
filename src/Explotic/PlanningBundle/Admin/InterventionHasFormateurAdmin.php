<?php
namespace Explotic\PlanningBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of InterventionHasFormateurAdmin
 *
 * @author adarr
 */


class InterventionHasFormateurAdmin extends Admin{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
                ->add('formateur')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter) {
        
        $filter
                ->add('formateur')
            ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper                 
                ->add('formateur')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper            
                ->add('formateur','sonata_type_model_list',
                    array(
                        )
                )                   
        ;
    }
    
    public function prePersist($object) {
        $object->getFormateur()->addInterventionHasFormateur($object);
    }
    
    public function preUpdate($object) {
        $object->getFormateur()->addInterventionHasFormateur($object);
    }
    
}

?>
