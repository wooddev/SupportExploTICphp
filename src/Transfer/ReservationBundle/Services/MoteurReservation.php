<?php
namespace Transfer\ReservationBundle\Services;
use \Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Criteria;
use Transfer\ReservationBundle\Services\AccesParametres;
use Transfer\ProfilBundle\Services\AccesProfil;
use Transfer\ReservationBundle\Generateurs\CreneauModeleGen;
/**
 * Description of moteurReservation
 *
 * @author Adrien
 */

class MoteurReservation {
    //put your code here
    
    private $em;
    private $parametres;
    private $profil;
    
    public function __construct(EntityManager $em, 
                                AccesParametres $parametres,
                                AccesProfil $profil) {
        $this->em=$em;
        $this->parametres = $parametres;
        $this->profil = $profil;
    } 
    
    /**
     * Méthode FixDisponibilites
     * 
     * Recalcule la disponibilité des créneaux modèles par type de camion,
     * en fonction des param de réservation et des créneaux prefs associés
     * 
     * @param type $creneaux
     * @param array $options : 
     *  - persist / boolean if true, les créneaux sont persistés en bdd 
     * 
     */
    public function fixDisponibilites($creneaux, $options){
        $em= $this->em;
                
        $fdMouvant = $em->getRepository('TransferReservationBundle:TypeCamion')->findOneByNom('Fond mouvant');
        $autres = $em->getRepository('TransferReservationBundle:TypeCamion')->findOneByNom('Autre type');       
                
        foreach($creneaux as $creneau){                        
            $this->calculDisponibilites($creneau, $fdMouvant, $autres,$options);  
            if(isset($options['persist']) && $options['persist'] ){
                $em->persist($creneau);   
            }
        }
        if(isset($options['persist']) && $options['persist']){
            $em->flush();
        }
        
    }
    
    public function fixDisponibilite($creneau, $options){
        $em= $this->em;
                
        $fdMouvant = $em->getRepository('TransferReservationBundle:TypeCamion')->findOneByNom('Fond mouvant');
        $autres = $em->getRepository('TransferReservationBundle:TypeCamion')->findOneByNom('Autre type');       
                                       
        $this->calculDisponibilites($creneau, $fdMouvant, $autres,$options);  
        if(isset($options['persist']) && $options['persist'] ){
            $em->persist($creneau);
            $em->flush();   
        }           
    }
        
    /**
     * Méthode permettant de calculer les dispo d'un créneau modèle particulier
     * @param type $creneauModele
     * @param type $fdMouvant
     * @param type $autres
     * @param type $param
     * @return type
     */
    
    public function calculDisponibilites($creneau,$fdMouvant,$autres,$options){
          
            $nbFdMouvant = $creneau->getNbReservation($fdMouvant);
            $nbAutres = $creneau->getNbReservation($autres);
            if(isset($options['persist']) && $options['persist'] ){
                foreach($creneau->getDisponibilites() as $dispo){
                    $this->em->remove($dispo);
                }  
            }
            $creneau->getDisponibilites()->clear();     
            
            $creneau->addDisponibilite(new \Transfer\ReservationBundle\Entity\Disponibilite());
            $creneau->getDisponibilites()->last()->setCreneau($creneau);   
            $creneau->getDisponibilites()->last()->setValeur($this->parametres->getDisponibiliteCamion('Fond mouvant')-$nbFdMouvant);
            $creneau->getDisponibilites()->last()->setTypeCamion($fdMouvant);   
            
            
            $creneau->addDisponibilite(new \Transfer\ReservationBundle\Entity\Disponibilite());            
            $creneau->getDisponibilites()->last()->setCreneau($creneau);   
            $creneau->getDisponibilites()->last()->setValeur($this->parametres->getDisponibiliteCamion('Autre type')-$nbAutres);
            $creneau->getDisponibilites()->last()->setTypeCamion($autres); 
            
            $creneau->setDisponibiliteTotale($this->parametres->getDisponibiliteTotale()-$nbFdMouvant-$nbAutres);

            return $creneau;
    }
    
    public function reduireDisponibilite( $creneau,$typeCamion){       
           
        $criteriaDispo = Criteria::create()                            
                           ->Where(Criteria::expr()
                                ->eq("typeCamion",$typeCamion));        
        $dispo = $creneau->getDisponibilites()->matching($criteriaDispo)->first();                
        if( ($creneau->getDisponibiliteTotale() >0) AND ($dispo->getValeur()>0) ){
            $creneau->setDisponibiliteTotale($creneau->getDisponibiliteTotale()-1);
            $dispo->setValeurDown();
            $this->em->persist($dispo);
            $this->em->persist($creneau);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function augmenterDisponibilite($creneau,$typeCamion){        
        $criteria = Criteria::create()
                           ->Where(Criteria::expr()
                                ->eq("typeCamion",$typeCamion));        
        $dispo = $creneau->getDisponibilites()->matching($criteria)->first();   
        
        if( $dispo->getValeur()<$this->parametres->getDisponibiliteCamion($typeCamion->getNom())
            &&   $creneau->getDisponibiliteTotale()<$this->parametres->getDisponibiliteTotale() )
        {
            $creneau->setDisponibiliteTotale($creneau->getDisponibiliteTotale()+1);
            $dispo->setValeurUp();
            $this->em->persist($dispo);
            $this->em->persist($creneau);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function vidangePanier($reservationClassName, $transporteur){
        //Vidange du panier
        //Recherche de rdv provisoires existants 
        $provisoires = $this->em->getRepository($reservationClassName)
                                ->findByStatutRdvForTrsp('provisoire', $transporteur);
        //suppression des provisoires existants
        if($provisoires){
            foreach ($provisoires as $provisoire){
                //Remontée des dispo totales et par type de camion
                $creneauRdvProvisoire = $provisoire->getCreneauRdv();
                $this->augmenterDisponibilite($creneauRdvProvisoire, $provisoire->getTypeCamion());
                $this->em->persist($creneauRdvProvisoire);               
                $this->em->remove($provisoire);
            }
            $this->em->flush(); 
            return true; 
        }  
        return false;        
    }
    
    public function vidangeSelection($rdvsSelection){
        //Vidange du panier

        //suppression des provisoires transmis
        foreach ($rdvsSelection as $provisoire){
            //Remontée des dispo totales et par type de camion
            $creneauRdvProvisoire = $provisoire->getCreneauRdv();
            $this->augmenterDisponibilite($creneauRdvProvisoire, $provisoire->getTypeCamion());
            $this->em->persist($creneauRdvProvisoire);               
            $this->em->remove($provisoire);
        }
        $this->em->flush();      
    }
    
    public function reservation($creneau,$typeCamion,$transporteur,$options=array('vidange'=>true)){
        //Identification des classes créneaux et réservation
        $className = get_class($creneau);
        $reservationClassName = $this->parametres->getReservationClassName($className);
        //Actualisation du creneau (Réduit le risque de conflit en cas de réservation simultanée)
        $creneauSync = $this->em->getRepository($className)->find($creneau->getId());
        
        //Tentative de blocage du créneau (réduction de sa disponibilité
        // >> Si réussite blocage :
        if($this->reduireDisponibilite( $creneauSync,$typeCamion)){
            try{
                if($this->parametres->getVidange($className) && $options['vidange']==true){
                    //Vidange du panier du transporteur si requis par le type de réservation
                    $this->vidangePanier($reservationClassName, $transporteur);
                }

                // création de la reservation recherchée
                $reservation = new $reservationClassName();                
                $reservation->init($creneauSync, $typeCamion,$this->parametres->getReservationOptions($className));       

                // Création de l'évenement de réservation si requis par le type de réservation
                if($this->parametres->getEvenement($className)){
                    $evenement = new \Transfer\ReservationBundle\Entity\Evenement();
                    $evenement->setRdv($reservation);
                    $evenement->setTransporteur($transporteur);
                    $evenement->setType('reservation');
                }else{
                    $reservation->setTransporteur($transporteur);
                }

                $this->em->persist($reservation);
                if($this->parametres->getEvenement($className)){
                    $this->em->persist($evenement);
                }
                $this->em->flush();
                return true;
            }catch(Exception $e){
                $this->augmenterDisponibilite($creneauSync, $typeCamion);
            }            
        }else{
            return false;
        }         
    }    
}

?>
