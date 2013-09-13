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
        $currentStagiaireId = $this->getRoot()->getSubject()->getId();
//        $user = $this->currentUser;
        parent::configureFormFields($formMapper);
        $formMapper
            ->with('ExploTIC')
                ->add('marchePiedInfo','checkbox',array('required'=>false))
                ->add('gerant','checkbox',array('required'=>false))                
                ->add('forfaitTelephone','text')
                ->add('niveauInfo','choice', array(
                    'choices'=>array('faible'=>'Faible','moyen'=>'Moyen','bon'=>'Bon','NC'=>'NC')
                ))
                ->add('typeEmploi','text')
                ->add('opca','choice', array(
                    'choices'=>array('VIVEA'=>'VIVEA','FAFSEA'=>'FAFSEA','OPCA3+'=>'OPCA3','Autre'=>'Autre')
                ))
                ->add('commentaire','textarea')
                
//                ->add('entreprise','sonata_type_admin')
//                ->add('machine','sonata_type_model',array(
//                    'query'=>function(\Explotic\TiersBundle\Entity\MachineRepository $er) use ($currentStagiaireId)
//                            {
//                                return $er->createQueryBuilder('m')
//                                        ->from('ExploticTiersBundle:Machine','m')
//                                        ->leftJoin('m.stagiaires','st')
//                                        ->leftJOin('st.entreprise','entst')                                        
//                                        ->leftJoin('m.entreprise','entm')
//                                        ->andWhere('entst.id = entm.id')
//                                        ->andWhere('entst.id = :id')
//                                        ->setParameter('id',$currentStagiaireId)
//                                    ;
//                            }
//                ))
//                ->add('recruteur','sonata_type_model')
//                ->add('postes','sonata_type_model_list',array(
//                    'class'=>'Explotic\TiersBundle\Entity\Poste',
//                    'query'=>function(\Explotic\TiersBundle\Entity\PosteRepository $er) use ($currentStagiaireId)
//                            {
//                                return $er->createQueryBuilder('p')
//                                        ->from('ExploticTiersBundle:Poste','p')
//                                        ->leftJoin('p.stagiaire','st')
//                                        ->andWhere('st.id = :id')
//                                        ->setParameter('id',$currentStagiaireId)
//                                        ;
//                            }                    
//                    ))
//                ->add('programmes','sonata_type_model_list',array(
//                    'class'=>'Explotic\TiersBundle\Entity\Programme',
//                    'query'=>function(\Explotic\TiersBundle\Entity\ProgrammeRepository $er) use ($currentStagiaireId)
//                            {
//                                return $er->createQueryBuilder('p')
//                                        ->from('ExploticFormationBundle:Programmes','p')
//                                        ->leftJoin('p.stagiaire','st')
//                                        ->andWhere('st.id = :id')
//                                        ->setParameter('id',$currentStagiaireId)
//                                        ;
//                            }                    
//                    ))
            ->end()
            ;
        
        $formMapper
                ->add('entreprise','sonata_type_model_list')
                ->add('machine','sonata_type_model_list', array(
                                'required'=>false,))                
            ;
                        
        
    }
}

?>
