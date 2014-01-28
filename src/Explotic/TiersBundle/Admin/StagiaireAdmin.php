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
use Sonata\AdminBundle\Route\RouteCollection;
/**
 * Description of StagiaireAdmin
 *
 * @author Adrien Arraiolos
 */
class StagiaireAdmin extends \Explotic\TiersBundle\Admin\ProfilAdmin
{
    
    private $em;
    
    public function setEntityManager(\Doctrine\ORM\EntityManager $em){
        $this->em = $em;
    }
    
        /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        if($this->isGranted('ROLE_ADMIN')){
            return $query;
        }elseif($this->isGranted('ROLE_RECRUTEUR')){
            $repo = $this->em->getRepository('ExploticTiersBundle:Stagiaire');
            $queryBuilder = $repo->createQueryBuilder('s')
                    ->leftJoin('s.recruteur','r')
                    ->where('r.id = :rid')
                    ->setParameter('rid',$this->getSecurityContext()->getToken()->getUser()->getId());
            return new \Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery($queryBuilder);
        }else{
            return $query;
        } 
    }
    
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
        
        
        $queryMachine = $this->em->getRepository('ExploticTiersBundle:Machine')->createQueryBuilder('m')   
                                                    ->leftJoin('m.entreprise','e')
                                                    ->leftJoin('e.recruteurs','r')
                                                    ->andWhere('r.id= :rid')
                                                    ->setParameter('rid', $this->securityContext->getToken()->getUser()->getId());

                                        
        
        $formMapper

            ->with('Emploi')
                ->add('entreprise','sonata_type_model_list')
                ->add('gerant','checkbox',array('required'=>false))    
                ->add('typeEmploi','text')
            ->end()
            ->with('Formation')
                ->add('numDevis')
                ->add('dateDevis')
                ->add('opca','choice', array(
                    'choices'=>array('VIVEA'=>'VIVEA','FAFSEA'=>'FAFSEA','OPCA3+'=>'OPCA3','Autre'=>'Autre')
                ))
                ->add('niveauInfo','choice', array(
                    'choices'=>array('faible'=>'Faible','moyen'=>'Moyen','bon'=>'Bon','NC'=>'NC')
                ))                
                ->add('marchePiedInfo','checkbox',array('required'=>false))                
                ->add('programmes','sonata_type_collection', array(
                            "required"=>false,
                            "by_reference"=>false,
                            
                            ),
                        array(
                            'inline'=>'natural',
                            'edit'=>'inline',
                            ))
            ->end()
            ->with('Déploiement')
                ->add('postes','sonata_type_collection',
                        array(
                            'type_options'=>array('delete'=>true,'btn_delete'=>true,'btn_add'=>true),
                            "required"=>false,
                            "by_reference"=>false,
                            ),
                        array(
                            'inline'=>'table',
                            'edit'=>'inline',
                            )
                        )
                ->add('machine','sonata_type_model', array(
                                'class'=>'ExploticTiersBundle:Machine',
                                'query'=> $queryMachine,
                                'required'=>false,)) 
                ->add('forfaitTelephone','text',array('required'=>false))
                ->add('commentaire','textarea',array('required'=>false))
            ->end()                   
        ;
        
        if($this->isGranted('ROLE_ADMIN')){
            $formMapper
            ->with('Recrutement')
                ->add('recruteur')
            ->end()                   
        ;
        }
                        
        
    }
           
    public function prePersist($user) {
        parent::prePersist($user);      
        foreach($user->getPostes() as $poste){
            $poste->setStagiaire($user);
        }
        $user->setPostes($user->getPostes());
        foreach($user->getProgrammes() as $prog){
            $prog->setStagiaire($user);
        }
        $user->setProgrammes($user->getProgrammes());
        
        if($user->getMachine()){                 
            $user->getMachine()->addStagiaire($user);
            $user->getMachine()->setEntreprise($user->getEntreprise());
            $user->setMachine($user->getMachine());
        }
        if($user->getEntreprise()){
            $user->getEntreprise()->addStagiaire($user); 
            if($user->getMachine()){ 
                $user->getEntreprise()->addMachine($user->getMachine());
            }
            $user->setEntreprise($user->getEntreprise());
        }  
        
        if(get_class($this->getSecurityContext()->getToken()->getUser())=='Explotic\TiersBundle\Entity\Recruteur'){
            $user->setRecruteur($this->getSecurityContext()->getToken()->getUser());
            $this->getSecurityContext()->getToken()->getUser()->addStagiaire($user);
        }
    }
    public function preUpdate( $user) {
        parent::preUpdate($user);
        
        foreach($user->getPostes() as $poste){
            $poste->setStagiaire($user);
        }
        $user->setPostes($user->getPostes());
        foreach($user->getProgrammes() as $prog){
            $prog->setStagiaire($user);    
        }
        $user->setProgrammes($user->getProgrammes());
        
        if($user->getMachine()){                 
            $user->getMachine()->addStagiaire($user);
            if($user->getEntreprise()){
                $user->getMachine()->setEntreprise($user->getEntreprise());  
            }
            $user->setMachine($user->getMachine());
        }
        if($user->getEntreprise()){
            $user->getEntreprise()->addStagiaire($user);
            if($user->getMachine()){ 
                $user->getEntreprise()->addMachine($user->getMachine());
            }
            $user->setEntreprise($user->getEntreprise());
        }
        
        if(get_class($this->currentUser)=='Explotic\TiersBundle\Entity\Recruteur'){
            $user->setRecruteur($this->currentUser);
            $this->currentUser->addStagiaire($user);
        }
    }
}

?>
