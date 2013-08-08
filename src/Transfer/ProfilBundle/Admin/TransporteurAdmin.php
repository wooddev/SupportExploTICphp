<?php
namespace Transfer\ProfilBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Description of ProfilAdmin
 *
 * @author adarr
 */


class TransporteurAdmin extends Admin{
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('priorite')
            ->add('quota')
        ;
    }
     /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('nom')
            ->add('quota')
            ->add('priorite')                
        ;
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('nom')
                ->add('priorite')
                ->add('quota')
            ->end()
        ;
    }
 
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('priorite')
            ->add('quota')
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
