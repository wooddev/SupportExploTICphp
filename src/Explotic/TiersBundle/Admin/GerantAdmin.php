<?php
namespace Explotic\TiersBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of ProfilAdmin
 *
 * @author adarr
 */


class GerantAdmin extends ProfilAdmin
{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        $listMapper
                ->add('entreprise')
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        parent::configureDatagridFilters($filterMapper);
        $filterMapper
                ->add('entreprise')
           ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowField($showMapper);
        $showMapper
                ->add('entreprise');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper
                ->with('Profile')
                    ->add('commentaires','textarea')
                ->end()
                ;

    }
    
}

?>