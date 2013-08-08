<?php
namespace Transfer\ProfilBundle\Services;


/**
 * Description of AccesProfil
 *
 * @author Adrien
 */
class AccesProfil {

    private $securityContext;
    private $user;
    private $em;
    
    public function __construct(\Symfony\Component\Security\Core\SecurityContext $securityContext, \Doctrine\ORM\EntityManager $em) {
        $this->securityContext=$securityContext;
        if( is_object($this->securityContext->getToken())){
           $user = $this->securityContext->getToken()->getUser();        
            if(! is_object($user))
            {
               // throw new \Exception('Veuillez vous authentifier');          
            }else{ 
                $this->user=$user;
            }
        }
        $this->em  = $em;
    }
    
    public function getAgentDab(){
        $agent = $this->em
                    ->getRepository('TransferProfilBundle:AgentDab')
                        ->find($this->user->getId());
        if(!$agent){
            throw $this->createNotFoundException('Le compte n\'appartient pas à un agent DAB ');

        }
        return $agent;
    }
    
    public function getAgentTrsp(){
        $agent = $this->em
                    ->getRepository('TransferProfilBundle:AgentTrsp')
                        ->find($this->user->getId());
        if(!$agent){
            throw $this->createNotFoundException('Le compte n\'appartient pas à un agent transporteur ');

        }
        return $agent;
    }
    
    public function getAgentReception(){
        $agent = $this->em
                    ->getRepository('TransferProfilBundle:AgentReception')
                        ->find($this->user->getId());
        if(!$agent){
            throw $this->createNotFoundException('Le compte n\'appartient pas à un agent réceptionnaire ');

        }
        return $agent;    
    }
    
    public function getTransporteur(){
        /////////////////////////////////////////////////////////////////
        //////Récupération du transporteur associé à l'utilisateur///////
        
        $user = $this->getAgentTrsp();

        if(!(is_object($user->getTransporteur()))){
            throw new \Exception("
                L'administrateur doit relier votre compte à une entreprise de transport");          
        }   
        return $user->getTransporteur();
        //////////////////////////////////////////////////////////////
    }
    
    public function getUser(){  
        return $this->user;
        //////////////////////////////////////////////////////////////
    }
    
    public function getAgentListe(){
        
        $profils= array();        
        if(!(null===$this->user->getAgentDab())){
            $profils['AgentDab'] = $this->user->getAgentDab();
        }            
        if(!(null===$this->user->getAgentTrsp())){
            $profils['AgentTrsp'] = $this->user->getAgentTrsp();
        }
        return $profils;        
    }
    
    public function getAgent($type){
        switch($type){
            case 'AgentDab' : 
                if(!(null===$this->user->getAgentDab())){
                    return $this->user->getAgentDab();
                }else{
                    return false;
                }
            break;
            case 'AgentTrsp' :
                if(!(null===$this->user->getAgentTrsp())){
                    return $this->user->getAgentTrsp();
                }else{
                    return false;
                }
            break;
        }       
    }     
}
?>
