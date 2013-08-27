<?php
namespace Transfer\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypePosteAdmin
 *
 * @author adarr
 */
class TypePosteAdmin extends Admin {
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('disponibilite')
        ;
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')                      
            ->add('disponibilite')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('disponibilite')
            ->add('_action', 'actions', array(
                'actions' => array(
                'view' => array(),
                'edit' => array(),
                'delete' => array(),
                )
            ))
        ;        
    }
}

?>
