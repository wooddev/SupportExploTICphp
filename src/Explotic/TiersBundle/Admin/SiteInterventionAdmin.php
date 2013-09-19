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
class SiteInterventionAdmin extends Admin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('localisation')
            ->add('_action','actions',array(
                'actions'=>array(
                    'view'=>array(),
                    'edit'=>array(),
                )
            ))

        ;

        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   
        $showMapper
                ->add('localisation.commune')
                ->add('localisation.cp')
                ->add('localisation.geometry',null, array('template'=>'ExploticAdminBundle:Admin:show_localisation.html.twig'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {   
        $formMapper
                ->add('localisation', 'sonata_type_admin',array(
                    'btn_delete'=>false,
                    'btn_add'=>false,
                ))  
                ->add('commentaires','textarea',array('required'=>false))
            ;
        
    }

}

?>
