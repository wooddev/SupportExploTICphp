<?php
namespace Explotic\TiersBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Description of EntrepriseAdmin
 *
 * @author Adrien Arraiolos
 */
class OrganismeAdmin extends Admin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('raisonSociale')
            ->add('formateur')
        ;

        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('raisonSociale')           
            ->add('formateur')
            ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   
        $showMapper
            ->with('ExploTIC')
                ->add('raisonSociale')
                ->add('formateur')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {   
        $formMapper
            ->with('ExploTIC')
                ->add('raisonSociale','text')  
                ->add('salles','sonata_type_collection')
            ->end()
            ;
        
    }

}

?>
