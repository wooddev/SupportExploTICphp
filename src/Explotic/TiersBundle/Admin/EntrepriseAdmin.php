<?php
namespace Explotic\TiersBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Description of EntrepriseAdmin
 *
 * @author Adrien Arraiolos
 */
class EntrepriseAdmin extends Admin
{    
    protected $securityContext;
    protected $currentUser;
    
    public function setSecurityContext(SecurityContext $sc){
        $this->securityContext = $sc;
        if(!null===$this->currentUser = $this->securityContext->getToken()){
            $this->currentUser = $this->securityContext->getToken()->getUser();
        }
    }
    public function getSecurityContext(){
        return $this->securityContext;
    }
    public function getCurrentUser() {
        return $this->currentUser;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('raisonSociale')
            ->add('versionExplotic')
//            ->add('commentaires')
            ->add('stagiaires')
//            ->add('machines')
//            ->add('employesrecruteurs')
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
//            ->add('machines')
//            ->add('employesrecruteurs')
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
//                ->add('bureau','string',array(
//                    'template'=>'ExploticAdminBundle:Admin:show_bureau.html.twig'
//                ))
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
                ->add('bureau','gmaps_address_picker')
            ->end()
            ;
        
        if($this->isGranted('ROLE_ADMIN')){
            $formMapper
            ->with('Recruteurs')
                ->add('recruteurs', 'sonata_type_model', array('required' => false, 'expanded' => true, 'multiple' => true))
            ->end()
            ;
        }
        
    }
    
   
    public function prePersist($object) {
        parent::prePersist($object);
        if($object->getBureau()){
            $object->getBureau()->setEntreprise($object);
        }
        if($object->getGerant()){
            $object->getGerant()->setEntreprise($object);
        }
    }
    public function preUpdate($object) {
        parent::preUpdate($object);
        if($object->getBureau()){
            $object->getBureau()->setEntreprise($object);
        }
        if($object->getGerant()){
            $object->getGerant()->setEntreprise($object);
        }        
        if(get_class($this->currentUser)=='Explotic\TiersBundle\Entity\Recruteur'){
            $object->addRecruteur($this->currentUser);
            $this->currentUser->addEntreprise($object);
        }
    }
}

?>
