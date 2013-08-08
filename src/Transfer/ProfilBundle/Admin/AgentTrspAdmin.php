<?php
namespace Transfer\ProfilBundle\Admin;
use Sonata\UserBundle\Admin\Entity\UserAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
/**
 * Description of AgentTrspAdmin
 *
 * @author Adrien
 */
class AgentTrspAdmin extends ProfilAdmin {
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper
            ->with('Transporteur')
                ->add('transporteur','sonata_type_model_list')                
            ->end()
        ;
    }
 
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        $listMapper            
                ->add('transporteur')
        ;
    }
 
}

?>
