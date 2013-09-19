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
class LocalisationAdmin extends Admin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->add('commune')
                ->add('cp')
                ->add('geometry')
        ;

        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
                ->add('commune')
                ->add('cp')
            ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   
        $showMapper
            ->with('ExploTIC')
                ->add('commune')
                ->add('cp')
                ->add('geometry')
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
                ->add('commune')
                ->add('cp')
                ->add('geometry','gmaps_picker',array(
                    'label'=>'PointGPS',
                    'data_class'=>'Explotic\TiersBundle\Entity\Geometry'
                )) 
            ->end()
            ;
        
    }

}

?>
