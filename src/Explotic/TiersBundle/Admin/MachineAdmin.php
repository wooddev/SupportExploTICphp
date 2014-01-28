<?php
namespace Explotic\TiersBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
/**
 * Description of ProfilAdmin
 *
 * @author adarr
 */


class MachineAdmin extends Admin{
    protected $securityContext;
    
    public function setSecurityContext(SecurityContext $sc){
        $this->securityContext = $sc;
        if(!null===$this->currentUser = $this->securityContext->getToken()){
            $this->currentUser = $this->securityContext->getToken()->getUser();
        }
    }
    public function getSecurityContext(){
        return $this->securityContext;
    }
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
            $repo = $this->em->getRepository('ExploticTiersBundle:Machine');
            $queryBuilder = $repo->createQueryBuilder('m')
                    ->leftJoin('m.entreprise','e')
                    ->leftJoin('e.recruteurs','r')
                    ->andWhere('r.id = :rid')
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
                    'show' => array(),
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
        $secu = $this->securityContext;
        if($this->isGranted('ROLE_ADMIN')){
            $filterMapper->add('entreprise');        
        }elseif($this->isGranted('ROLE_RECRUTEUR')){        
            $filterMapper
                ->add('entreprise',null,array(),null,array(
                    'class'=>'ExploticTiersBundle:Entreprise',
                    'query_builder'=> function(\Doctrine\ORM\EntityRepository $er) use ($secu){
                        return $er->createQueryBuilder('e')                                
                                ->leftJoin('e.recruteurs','r')
                                ->andWhere('r.id= :rid')
                                ->setParameter('rid', $secu->getToken()->getUser()->getId());
            
                    }
                ));
        }
        $filterMapper
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
        ;

    }
    
    public function prePersist($object) {
        parent::prePersist($object);
        if(!$object->getStagiaires()->isEmpty()){
            $object->setEntreprise($object->getStagiaires()->last()->getEntreprise());
        }
    }
    public function preUpdate($object) {
        parent::preUpdate($object);
        if(!$object->getStagiaires()->isEmpty()){
            $object->setEntreprise($object->getStagiaires()->last()->getEntreprise());
        }
    }
    
}

?>
