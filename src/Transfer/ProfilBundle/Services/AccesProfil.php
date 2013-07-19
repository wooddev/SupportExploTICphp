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
    
    public function __construct(\Symfony\Component\Security\Core\SecurityContext $securityContext) {
        $this->securityContext=$securityContext;
        $user = $this->securityContext->getToken()->getUser();
        if(! is_object($user))
        {
            throw new \Exception('Veuillez vous authentifier');          
        }else{ 
            $this->user=$user;
        }
    }
    
    public function getTransporteur(){
        /////////////////////////////////////////////////////////////////
        //////Récupération du transporteur associé à l'utilisateur///////
        
        $user = $this->getUser();
        if(!(is_object($user->getAgentTrsp()))){
            throw new \Exception("
                L'administrateur doit relier votre compte à une entreprise de transport");          
        }   
        return $user->getAgentTrsp()->getTransporteur();
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
