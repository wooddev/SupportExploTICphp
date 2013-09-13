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
class EntrepriseAdmin extends MyAdmin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('raisonSociale')
            ->add('versionExplotic')
            ->add('commentaires')
            ->add('stagiaires')
            ->add('machines')
            ->add('employesrecruteurs')
            ->add('recruteurs')
        ;

        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('raisonSociale')           
            ->add('versionExplotic')
            ->add('stagiaires')
            ->add('machines')
            ->add('employesrecruteurs')
            ->add('recruteurs')
            ;
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   
        $showMapper
            ->with('ExploTIC')
                ->add('raisonSociale')
                ->add('siret')
                ->add('ape')
                ->add('cnil')
                ->add('versionExplotic')
                ->add('commentaires')
                ->add('stagiaires')
                ->add('machines')
                ->add('employesrecruteurs')
                ->add('recruteurs')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {   
        $formMapper
            ->with('ExploTIC')
                ->add('raisonSociale','text')
                ->add('siret','text')
                ->add('ape','text')
                ->add('cnil','text')
                ->add('versionExplotic','text',array('required'=>false))
                ->add('commentaires','textarea', array(
                                'required'=>false,))
                ->add('gerant','sonata_type_model',array(
                                'required'=>false,)
                        )
                ->add('stagiaires', 'sonata_type_collection', array(
                                'required'=>false,
                                'cascade_validation' => true,
                            ), array(
                                'edit'              => 'standard',
                                'inline'            => 'standard',
                                'sortable'          => 'position',
                                'admin_code'        => 'explotic_tiers.admin.stagiaire'
                            )
                        )
//                ->add('machines','sonata_type_model_list',array(
//                    'class'=>'Explotic\TiersBundle\Entity\Machine'
//                ))
//                ->add('employesrecruteurs','sonata_type_model_list',array(
//                    'class'=>'Explotic\TiersBundle\Entity\Recruteur'
//                ))
//                ->add('recruteurs','sonata_type_model_list',array(
//                    'class'=>'Explotic\TiersBundle\Entity\Recruteur'
//                ))
            ->end()
            ;
        
    }

}

?>
