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
                ->addIdentifier('reference')
                ->add('marque')
                ->add('modele')
                ->add('logiciel')
                ->add('stagiaires')
                ->add('entreprise')
                ->add('numeroEntreprise')
                ->add('_action', 'actions', array(
                    'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    )
                ))
//                ->add('stagiaire')                
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
                ->add('entreprise')
                ->add('marque')
                ->add('modele')
                ->add('logiciel')
           ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('entreprise')
                ->add('stagiaire')
                ->add('numeroEntreprise')                
                ->add('reference')
                ->add('modele')
                ->add('marque')
                ->add('logiciel')
                ->add('transfertData')
                ->add('forfait')
                ->add('commentaire')
                ->add('email')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('numeroEntreprise','integer')                
                ->add('reference')
                ->add('modele')
                ->add('marque')
                ->add('logiciel','choice',array(
                    'choices'=>array('TM300'=>'TM300','H09'=>'H09','OPTI4G'=>'OPTI4G','Autre'=>'Autre')))
                ->add('transfertData','checkbox',array('required'=>false))
                ->add('forfait',null, array(
                                'required'=>false,))
                ->add('commentaire','textarea', array(
                                'required'=>false,))
                ->add('email','email', array(
                                'required'=>false,))
                ->add('entreprise','sonata_type_model_list')
        ;

    }
    
}

?>
