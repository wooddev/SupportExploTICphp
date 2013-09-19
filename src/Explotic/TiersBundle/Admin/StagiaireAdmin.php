<?php
namespace Explotic\TiersBundle\Admin;

use Sonata\UserBundle\Admin\Entity\UserAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
/**
 * Description of StagiaireAdmin
 *
 * @author Adrien Arraiolos
 */
class StagiaireAdmin extends \Explotic\TiersBundle\Admin\ProfilAdmin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        parent::configureDatagridFilters($filterMapper);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   parent::configureShowFields($showMapper);
        $showMapper
            ->with('ExploTIC')

            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    { 
//        if(!(null===$this->getRoot()->getSubject()->getEntreprise())){
//            $currentEntrepriseId = $this->getRoot()->getSubject()->getEntreprise()->getId();
//        }

//        $currentStagiaireId = $this->getSecurityContext()->getToken()->getUser()->getId();
//        $user = $this->currentUser;
        parent::configureFormFields($formMapper);
        $formMapper

            ->with('Emploi')
                ->add('entreprise','sonata_type_model_list')
                ->add('gerant','checkbox',array('required'=>false))    
                ->add('typeEmploi','text')
            ->end()
            ->with('Formation')
                ->add('opca','choice', array(
                    'choices'=>array('VIVEA'=>'VIVEA','FAFSEA'=>'FAFSEA','OPCA3+'=>'OPCA3','Autre'=>'Autre')
                ))
                ->add('niveauInfo','choice', array(
                    'choices'=>array('faible'=>'Faible','moyen'=>'Moyen','bon'=>'Bon','NC'=>'NC')
                ))                
                ->add('marchePiedInfo','checkbox',array('required'=>false))
            ->end()
            ->with('Déploiement')
                ->add('postes','sonata_type_collection',array("required"=>false),array())
//                ->add('programmes','sonata_type_collection')
//       
                ->add('machine','sonata_type_model_list', array(
                                'required'=>false,)) 
                ->add('forfaitTelephone','text',array('required'=>false))
                ->add('commentaire','textarea',array('required'=>false))
            ->end()                   
        ;
                        
        
    }
    
}

?>
