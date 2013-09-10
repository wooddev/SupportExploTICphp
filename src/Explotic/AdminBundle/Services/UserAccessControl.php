<?php
namespace Explotic\AdminBundle\Services;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserAccesControl
 *
 * @author Grumpf
 */
class UserAccessControl 
{   
    
    private $user,
            $securityContext,
            $em;
    
    public function __construct(\Doctrine\ORM\EntityManager $em,
                                \Symfony\Component\Security\Core\SecurityContext $securityContext) 
    {
        $this->em=$em;
        $this->securityContext = $securityContext;        
        $this->user = $securityContext->getToken()->getUser();
    }
    
    public function ControlAccessToUser($givenUser){
        
        // si current_user == given_user
        if($this->user->getId() == $givenUser->getId()){
            return true;
        }
        
        // si current_user a recruté given_user
        if($this->securityContext->isGranted('ROLE_RECRUTEUR')){
            $recruteur = $this->em->getRepository('ExploticTiersBundle:Recruteur')->find($this->user->getId());           
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$givenUser->getId()));
            if(!$recruteur->getStagiaires()->matching($criteria)->isEmpty()){
                return true;
            }
        }
        
        // si current_user forme given_user
        if($this->securityContext->isGranted('ROLE_FORMATEUR')){
            $formateur = $this->em->getRepository('ExploticTiersBundle:Formateur')->find($this->user->getId());
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$givenUser->getId()));           
            if(!$formateur->getSessions()->isEmpty()){
                foreach($formateur->getSessions() as $session){                   
                    if(!$session->getStagiaires()->matching($criteria)->isEmpty()){
                        return true;
                    }
                }
            }
        }
        
        // si current_user employe given_user
        if($this->securityContext->isGranted('ROLE_ENTREPRISE')){
            $entreprise =  $this->em->getRepository('ExploticTiersBundle:Entreprise')->find($this->user->getId());
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$givenUser->getId()));
            if(!$entreprise->getStagiaires()->matching($criteria)->isEmpty()){
                return true;
            }
            if(!$entreprise->getEmployesrecruteurs()->matching($criteria)->isEmpty()){
                return true;
            }
        }
        
        //si current user est administrateur
        if($this->securityContext->isGranted('ROLE_ADMIN')){
            return true;
        }
        // si aucun des cas précédents
        throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Accès non autorisé');
    }
    
    public function controlAccessToSession($session){       
        // si current_user est stagiaire dans la session
        if($this->securityContext->isGranted('ROLE_STAGIAIRE')){
            $stagiaire = $this->em->getRepository('ExploticTiersBundle:Stagiaire')->find($this->user->getId());
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$session->getId())); 
            if(!$stagiaire->getSessions()->matching($criteria)->isEmpty()){
                return true;
            }
        }
        
        // si current_user est un recruteur dont un stagiaire est dans la session
        if($this->securityContext->isGranted('ROLE_RECRUTEUR')){
            $recruteur = $this->em->getRepository('ExploticTiersBundle:Recruteur')->find($this->user->getId());             
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$session->getId()));           
            if(!$recruteur->getStagiaires()->isEmpty()){
                foreach($recruteur->getStagiaires() as $stagiaire){
                    if(!$stagiaire->getSessions()->matching($criteria)->isEmpty()){
                        return true;
                    }
                }
            }
        }
        
        // si current_user est formateur de la session
        if($this->securityContext->isGranted('ROLE_FORMATEUR')){
            $formateur = $this->em->getRepository('ExploticTiersBundle:Formateur')->find($this->user->getId());
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$session->getId()));    
            if(!$formateur->getSessions()->matching($criteria)->isEmpty()){
                return true;
            }
        }
        
        // si current_user employe un stagiaire qui est dans la session
        if($this->securityContext->isGranted('ROLE_ENTREPRISE')){
            $entreprise =  $this->em->getRepository('ExploticTiersBundle:Entreprise')->find($this->user->getId());
            $criteria = Criteria::create()
                    ->where(Criteria::expr()
                                ->eq("id",$session->getId()));
            if(!$entreprise->getStagiaires()->isEmpty()){
                foreach($entreprise->getStagiaires() as $stagiaire){
                    if(!$stagiaire->getSessions()->matching($criteria)->isEmpty()){
                        return true;
                    }
                }
            }
        }
        
        //si current user est administrateur
        if($this->securityContext->isGranted('ROLE_ADMIN')){
            return true;
        }
        // si aucun des cas précédents
        throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Accès non autorisé');
    }
    
    public function controlAccessToShowAgenda($agenda){
        $stagiaires = $this->em->getRepository('ExploticTiersBundle:Staigaires')->findByCalendrier($agenda);
        $formateurs = $this->em->getRepository('ExploticTiersBundle:Formateurs')->findByCalendrier($agenda);
        $sessions = $this->em->getRepository('ExploticPlanningBundle:Session')->findByCalendrier($agenda);
        
        if(!stagiaires){ //On a récupéré un stagiaire
            $this->ControlAccessToUser($stagiaires[0]);
        }
        if(!formateurs){                //On a récupéré un formateur   
            if($this->user->getId() == $formateurs[0]->getId()){
                return true;
            }
        }
        if(!sessions) { //On a récupéré une session
            $this->controlAccessToSession($sessions[0]);
        }
        throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Accès non autorisé');        
    }
    
    public function ControlAcessToEditAgenda($agenda){
        $this->controlAccessToShowAgenda($agenda);
        if($this->securityContext->isGranted('ROLE_ADMIN')){
            return true;
        }
        throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Accès non autorisé');        
    }
    
    
}

?>
