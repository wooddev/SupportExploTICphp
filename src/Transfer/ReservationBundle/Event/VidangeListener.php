<?php

namespace Transfer\ReservationBundle\Event;

use Transfer\ReservationBundle\Services\AccesParametres;
use Doctrine\ORM\EntityManager;
use Transfer\ReservationBundle\Services\MoteurReservation;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Description of VidangeListener
 *
 * @author adarr   
 */
class VidangeListener {
    //put your code here
    private $param;
    private $em;
    private $mr;
    
    public function __construct(AccesParametres $param, MoteurReservation $mr, EntityManager $em ) {
        $this->param = $param;
        $this->mr = $mr;
        $this->em = $em;
    }
    /*
     * Vidange les rdvs provisoires ayant dépassé la limite de validité fixé dans les paramètres
     */
    public function executeVidange(){
        //Contrôle du délai d'expiration (permet de ne faire le test que toutes les 5 minutes)
        if($this->param->getProchaineVidange()<= new \DateTime()){
            if($this->param->getEtatVidange()){
                $interval= new \DateInterval($this->param->getIntervalVidange());
                $rdvs = $this->em->getRepository('TransferReservationBundle:Rdv')
                                ->findProvisoires($interval);
                if( (!(null===$rdvs)) AND count($rdvs)>0){
                    $this->mr->vidangeSelection($rdvs);
                }  
            }
            //Définition de la prochaine heure de vidange
            $this->param->setProchaineVidange();
            
            /***********************************
             * PORTION DE CODE A DEPLACER DANS LISTENER DEDIE
             */
//            $this->mr->fixDisponibilites(
//               $this->em->getRepository('TransferReservationBundle:CreneauRdv')
//                   ->findForFix(), 
//               array('persist'=>true));
            //********************************
            
        }
        
    }
    /*
     * Définition de l'état des vidanges de panier
     * >> inactif pendant la période définie dans les param
     * >> état conservé dans les param réservés
     * >> état modifié si ne correspond pas au controle
     */
    protected function controlEtatVidange(){
        $date = new \DateTime();
        if( ($date >= $this->param->getDebutVidangeInact()) 
            AND 
            ($date <= $this->param->getFinVidangeInact()))
        {
            if($this->param->getEtatVidange()){
                $this->param->setEtatVidange(false);
            }
        }else{
            if(!$this->param->getEtatVidange()){
                $this->param->setEtatVidange(true);
            }
        }
    }
    
    public function onKernelController(FilterControllerEvent $event){
        $controller = $event->getController();
        if (!is_array($controller)){
            return;
        }
        if ($controller[0] instanceof \Transfer\ReservationBundle\Controller\VidangeRequiseController){
            $this->controlEtatVidange();
            $this->executeVidange();
        }        
    }
}

?>
