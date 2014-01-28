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

//   !!!!!!!!!!!!!!!!!!!!!!!!   DESACTIVE !!!!!!!!!
//    private $em;
//    
//    public function setEntityManager(\Doctrine\ORM\EntityManager $em){
//        $this->em = $em;
//    }
//    
//   /**
//     * {@inheritdoc}
//     */
//    public function createQuery($context = 'list')
//    {
//        $query = parent::createQuery($context);
//        
//        if($this->isGranted('ROLE_ADMIN')){
//            return $query;
//        }elseif($this->isGranted('ROLE_RECRUTEUR')){
//            $repo = $this->em->getRepository('ExploticTiersBundle:Gerant');
//            $queryBuilder = $repo->createQueryBuilder('g')
//                    ->leftJoin('g.entreprise','e')
//                    ->leftJoin('e.recruteurs','r')
//                    ->where('r.id = :rid')
//                    ->setParameter('rid',$this->getSecurityContext()->getToken()->getUser()->getId());
//            return new \Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery($queryBuilder);
//        }else{
//            return $query;
//        } 
//    }
//     
//    /**
//     * {@inheritdoc}
//     */
//    protected function configureListFields(ListMapper $listMapper)
//    {
//        parent::configureListFields($listMapper);
//        $listMapper
//                ->add('entreprise')
//            ;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    protected function configureDatagridFilters(DatagridMapper $filterMapper)
//    {
//        parent::configureDatagridFilters($filterMapper);
//        $filterMapper
//                ->add('entreprise')
//           ;
//        
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    protected function configureShowFields(ShowMapper $showMapper)
//    {
//        parent::configureShowField($showMapper);
//        $showMapper
//                ->add('entreprise');
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    protected function configureFormFields(FormMapper $formMapper)
//    {
//        parent::configureFormFields($formMapper);
//        $formMapper
//                ->with('Profile')
//                    ->add('commentaires','textarea')
//                ->end()
//                ;
//
//    }
//    
//    
//    
}

?>
