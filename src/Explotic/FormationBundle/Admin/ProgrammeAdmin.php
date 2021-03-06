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
                ->add('stagiaire')
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
                ->add('stagiaire')
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
                ));
        if($this->isGranted('ROLE_ADMIN')){
            $formMapper
                    ->add('accompagnement','choice',array(
                        'choices'=>array(
                            'nonRealise'=>'nonRealise',
                            'realise'=>'realise',
                            'enCours'=>'enCours',
                        )
                    ))
                    ->add('FormationSalle','choice',array(
                        'choices'=>array(
                            'nonRealise'=>'nonRealise',
                            'realise'=>'realise',
                            'enCours'=>'enCours',
                        )))
            ;        
        }

    }
    public function prePersist($object) {
        parent::prePersist($object);

    }
    public function preUpdate($object) {
        parent::preUpdate($object);

    }
    
}

?>
