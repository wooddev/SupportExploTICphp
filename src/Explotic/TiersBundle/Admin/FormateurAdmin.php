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
                ->add('entreprises')
                ->add('stagiaires')
                ->add('employeur')
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        parent::configureDatagridFilters($filterMapper);
        $filterMapper                
                ->add('entreprises')                
                ->add('stagiaires')
                ->add('employeur')
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
                    ->add('entreprises')
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
                    ->add('employeur','sonata_type_model_list')   
                ->end()
            ;

    }
    
}

?>
