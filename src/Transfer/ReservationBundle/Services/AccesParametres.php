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
        $className=str_replace('Proxies\__CG__\\', '',$className);
        return $this->paramReservation->getParametresReserves()[$className]['vidange'];
    }
    
    public function getReservationClassName($className){
        $className=str_replace('Proxies\__CG__\\', '',$className);
        return  $this->paramReservation->getParametresReserves()[$className]['reservation'];
    }
    public function getEvenement($className){
        $className=str_replace('Proxies\__CG__\\', '',$className);
        return  $this->paramReservation->getParametresReserves()[$className]['evenement'];
    }
    public function getReservationOptions($className){
        $options=array();
        $em=$this->em;
        $className=str_replace('Proxies\__CG__\\', '',$className);
        foreach($this->paramReservation->getParametresReserves()[$className]['options'] as $key=>$option){
            $repo = $em->getRepository($option['entity']);
            $repo2 = $em->getRepository('TransferReservationBundle:StatutCreneau');
            $all = $repo2->findAll();
            $options[$key]=$em->getRepository($option['entity'])->findOneBy(array($option['criteria']=>$option['value']));
        }
        return $options;
    }
    
    public function getIntervalVidange(){
        return $this->paramReservation->getParametres()['IntervalVidangeProvisoires'];
    }
    
    public function getDebutVidangeInact(){
        return new \DateTime($this->paramReservation->getParametres()['DebutVidangeInact']);
    }
    public function getFinVidangeInact(){
        return new \DateTime($this->paramReservation->getParametres()['FinVidangeInact']);
    }
    public function getEtatVidange(){
        return $this->paramReservation->getParametresReserves()['EtatVidange'];
    }
    public function setEtatVidange($etat){
        $this->paramReservation->getParametresReserves()['EtatVidange']=$etat;
        $this->em->persist($this->paramReservation);
        $this->em->flush();
    }
    public function getProchaineVidange(){
        return new \DateTime($this->paramReservation->getParametresReserves()['ProchaineVidange']);
    }
    public function setProchaineVidange(){        
        $dateHeure = new \DateTime();
        $dateHeure->add(new \DateInterval('PT30S'));
        $this->paramReservation->getParametresReserves()['ProchaineVidange'] = $dateHeure->format('Y/m/d h:i');
        $this->em->persist($this->paramReservation);
        $this->em->flush();
    }
    public function getIntervalleRecherche(){
        return $this->paramReservation->getParametres()['IntervalleRecherche'];
    }
}

?>
