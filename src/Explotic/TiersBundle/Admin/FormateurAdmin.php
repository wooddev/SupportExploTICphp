<?php
namespace Explotic\TiersBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of RecruteurAdmin
 *
 * @author adarr
 */


class FormateurAdmin extends ProfilAdmin
{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        $listMapper
                ->add('organisme')
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        parent::configureDatagridFilters($filterMapper);
        $filterMapper                
                ->add('organisme')
           ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowField($showMapper);
        $showMapper
                ->with('ExploTIC')
                    ->add('organisme')
                ->end()
                ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper   
                ->with('ExploTIC')
                    ->add('organisme','sonata_type_model_list')   
                ->end()
            ;

    }
    
}

?>
