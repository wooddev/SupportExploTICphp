<?php
namespace Transfer\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Description of StatutCreneauAdmin
 *
 * @author adarr
 */
class StatutCreneauAdmin extends Admin {
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
        ;
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')            
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('_action', 'actions', array(
                'actions' => array(
                'view' => array(),
                'edit' => array(),
                )
            ))
        ;        
    }
}

?>
