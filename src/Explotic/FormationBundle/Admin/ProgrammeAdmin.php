<?php
namespace Explotic\FormationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of ProfilAdmin
 *
 * @author adarr
 */


class ProgrammeAdmin extends Admin{
    
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {        
        $listMapper
                ->add('module')
                ->add('stagiare')
                ->add('accompagnement')
                ->add('formationSalle')
                ->add('_action', 'actions', array(
                    'actions' => array(
                    'view' => array(),
                    'edit' => array(),
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
                ->add('module')
                ->add('stagiare')
                ->add('accompagnement')
                ->add('formationSalle')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('module','entity',array(
                    'class'=>'ExploticFormationBundle:Module'
                ))
                ->add('accompagnement','choice',array(
                    'choices'=>array(
                        'nonRealise',
                        'realise',
                        'encours'
                    )
                ))
                ->add('FormationSalle','choice',array(
                    'choices'=>array(
                        'nonRealise',
                        'realise',
                        'encours'
                    )))
        ;

    }
    public function prePersist($object) {
        parent::prePersist($object);

    }
    public function preUpdate($object) {
        parent::preUpdate($object);

    }
    
}

?>
