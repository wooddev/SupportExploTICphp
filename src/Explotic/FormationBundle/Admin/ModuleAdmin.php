<?php
namespace Explotic\FormationBundle\Admin;

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


class ModuleAdmin extends Admin{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
                ->addIdentifier('reference')  
                ->add('nom')
            ;
    }



    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('Informations générales')
                ->add("reference")
                ->add('nom')
                ->add('tarif',"money")
                ->add('tarifplein','money')
                ->end()
                ->with('Contenu')
                ->add('description','textarea')                
                ->add('interventionSalles','sonata_type_collection',array('required'=>false))
                ->add('interventionEntreprises','sonata_type_collection',array('required'=>false))    
        ;

    }
    
}

?>
