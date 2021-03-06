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
class SalleAdmin extends SiteInterventionAdmin
{     
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
                ->add('adresseRue')
            ;
        parent::configureListFields($listMapper);
    }



    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        
        $showMapper
                ->add('adresseRue')                
        ;
        parent::configureShowFields($showMapper);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {        
        $formMapper
                ->add('adresseRue')                
        ;
        parent::configureFormFields($formMapper);


    }
}

?>
