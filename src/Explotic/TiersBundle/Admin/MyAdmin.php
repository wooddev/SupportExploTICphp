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
/**
 * Description of MyAdmin
 *
 * @author Adrien Arraiolos
 */
class MyAdmin extends Admin{
    /**
     * Security Context
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

    public function setSecurityContext(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

//    protected function configureRoutes(RouteCollection $collection)
//    {
//        //remove all routes except those, you are using in admin and you can secure by yourself
//        $collection
//                ->clearExcept(array(
//                    'list',
//                    'edit',
//                    'clear'
//                ))
//        ;
//    }
    public function getDatagrid() {
        parent::getDatagrid();
    }
    

    
}

?>
