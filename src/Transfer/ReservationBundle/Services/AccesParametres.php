<?php
namespace Transfer\ReservationBundle\Services;
use Transfer\ReservationBundle\Entity\ParamReservationRepository;
/**
 * Description of AccesParametres
 *
 * @author Adrien
 */
class AccesParametres {

    private $paramReservation;
    private $em;
    
    public function __construct(ParamReservationRepository $paramReservationRepository,
                                \Doctrine\ORM\EntityManager $em) {
        $this->paramReservation = $paramReservationRepository->findAll()[0];
        $this->em = $em;
    }
    
    public function getDisponibiliteTotale(){
        return $this->paramReservation->getParametres()['DisponibiliteTotale'];
    }
    public function getDisponibiliteCamion($typeCamionNom){     
        switch($typeCamionNom){
            case 'Fond mouvant':
                return $this->paramReservation->getParametres()['DisponibiliteFondMouvant'];
            break;
            case 'Autre type': 
                return $this->paramReservation->getParametres()['DisponibiliteAutresTypes'];
            break;
        }     
    }
    
    public function getVidange($className){
        return $this->paramReservation->getParametresReserves()[$className]['vidange'];
    }
    
    public function getReservationClassName($className){
        return  $this->paramReservation->getParametresReserves()[$className]['reservation'];
    }
    public function getEvenement($className){
        return  $this->paramReservation->getParametresReserves()[$className]['evenement'];
    }
    public function getReservationOptions($className){
        $options=array();
        $em=$this->em;
        foreach($this->paramReservation->getParametresReserves()[$className]['options'] as $key=>$option){
            $repo = $em->getRepository($option['entity']);
            $repo2 = $em->getRepository('TransferReservationBundle:StatutCreneau');
            $all = $repo2->findAll();
            $options[$key]=$em->getRepository($option['entity'])->findOneBy(array($option['criteria']=>$option['value']));
        }
        return $options;
    }
}

?>
