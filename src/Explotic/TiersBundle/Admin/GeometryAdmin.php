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
class GeometryAdmin extends Admin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('lat')
            ->add('lon')
        ;

        
    }


    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   
        $showMapper
            ->with('ExploTIC')
                ->add('lat')
                ->add('lon')
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
                ->add('lat')
                ->add('lon')
            ->end()
            ;
        
    }

}

?>
