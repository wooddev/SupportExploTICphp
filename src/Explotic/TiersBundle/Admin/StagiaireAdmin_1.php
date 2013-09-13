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
class StagiaireAdmin 
//extends \Explotic\TiersBundle\Admin\ProfilAdmin
{
        /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
//        parent::configureListFields($listMapper);
        $listMapper
                ->add('opca');


        
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
//        parent::configureDatagridFilters($filterMapper);
        $filterMapper
                ->add('opca');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {   
//        parent::configureShowFields($showMapper);
        $showMapper
            ->with('ExploTIC')
                ->add('opca')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    { 
//        $currentStagiaireId = $this->getRoot()->getSubject()->getId();
//        $user = $this->currentUser;
//        parent::configureFormFields($formMapper);
        $formMapper
            ->with('ExploTIC')
                ->add('opca','choice', array(
                    'choices'=>array('VIVEA'=>'VIVEA','FAFSEA'=>'FAFSEA','OPCA3+'=>'OPCA3','Autre'=>'Autre')
                ))
                ->add('commentaire','textarea')

            ->end()
            ;
        

                        
        
    }
}

?>
