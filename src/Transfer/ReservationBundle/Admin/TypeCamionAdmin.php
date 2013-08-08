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
 * Description of TypeCamionAdmin
 *
 * @author adarr
 */
class TypeCamionAdmin extends Admin {

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
        ;
    }
}

?>
