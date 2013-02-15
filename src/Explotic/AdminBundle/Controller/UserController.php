<?php

namespace Explotic\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\AdminBundle\Entity\User;
use Explotic\AdminBundle\Form\UserType;
use Explotic\AdminBundle\Form\UserRoleType;
use JMS\SecurityExtraBundle\Annotation\Secure;
/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        
        $usermanager = $this->get('fos_user.user_manager');
        $users = $usermanager->findUsers();
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('ExploticAdminBundle:User')->findAll();
//
        return $this->render('ExploticAdminBundle:User:index.html.twig', array(
            'entities' => $users,
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $MetaData= $em->getClassMetadata('Explotic\AdminBundle\Entity\User');
        $fields = array();
        
        foreach ($MetaData->fieldNames as $value){
            if(method_exists($entity,'get'.ucfirst($value))){
                $fields[$value]=array();
                $fields[$value]['val']= $entity->{'get'.ucfirst($value)}();
                $types=array();
                $types[$value] = gettype($entity->{'get'.ucfirst($value)}());
                
                if(is_object($fields[$value])){                    
                    $fields[$value]['typ']=  get_class_methods($entity->{'get'.ucfirst($value)}());
                }
                else {                    
                    $fields[$value]['typ']= gettype($entity->{'get'.ucfirst($value)}());
                }
            }            
        }
            
        return $this->render('ExploticAdminBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'properties' => $fields,
            'types' => $types));
    }

//    /**
//     * Displays a form to create a new User entity.
//     *
//     */
//    public function newAction()
//    {
//        $entity = new User();
//        $form   = $this->createForm(new UserType(), $entity);
//
//        return $this->render('ExploticAdminBundle:User:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Creates a new User entity.
//     *
//     */
//    public function createAction(Request $request)
//    {
//        $entity  = new User();
//        $form = $this->createForm(new UserType(), $entity);
//        $form->bind($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('ExploticAdminBundle:User:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing User entity's roles.
     *
     */
    public function editRoleAction($id)
    {
        $usermanager = $this->get('fos_user.user_manager');
        $entity = $usermanager->findUserBy(array('id'=>$id));
        $editForm = $this->createForm(new UserRoleType(), $entity);
        
        return $this->render('ExploticAdminBundle:User:edit_role.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    /**
     * Edits an existing User entity.
     *
     */
    public function updateRoleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserRoleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit_role', array('id' => $id)));
        }
        
        $usermanager = $this->get('fos_user.user_manager');
        $users = $usermanager->findUsers();
        
        return $this->render('ExploticAdminBundle:User:index.html.twig', array(
            'entities'      => $users,
        ));
    }
    
    
     /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $usermanager = $this->get('fos_user.user_manager');
        $entity = $usermanager->findUserBy(array('id'=>$id));
        $editForm = $this->createForm(new UserType(), $entity);
        
        return $this->render('ExploticAdminBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->bind($request);
                
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }
        
        $usermanager = $this->get('fos_user.user_manager');
        $users = $usermanager->findUsers();
        
        return $this->render('ExploticAdminBundle:User:index.html.twig', array(
            'entities'      => $users,
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticAdminBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
