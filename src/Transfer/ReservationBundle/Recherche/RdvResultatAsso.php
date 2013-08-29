<?php
namespace Transfer\ReservationBundle\Recherche;

use Transfer\ReservationBundle\Entity\CreneauRdv;
/**
 * Description of RdvRecherche
 *
 * Cette classe hérite de CréneauRdv
 * 
 *  --  Elle sert de support au tri des créneaux du plus proche au plus éloigné du créneau ciblé 
 * 
 * @author Adrien
 */
class RdvResultatAsso
{
    private $diffTemps;
    private $creneauRdv;
            
    public function getDiffTemps() {
        return $this->diffTemps;
    }

    public function setDiffTemps($diffTemps) {
        $this->diffTemps = $diffTemps;
    }
    
    public function getCreneauRdv() {
        return $this->creneauRdv;
    }

    public function setCreneauRdv($creneauRdv) {
        $this->creneauRdv = $creneauRdv;
    }
               
    public function __construct($creneauRdv = null, $rdvRecherche = null){
        if(!($creneauRdv ==null)){
            
            $this->creneauRdv = $creneauRdv;
            $dateHeureDebut=$creneauRdv->getDateHeureDebut();        
            if(!($rdvRecherche == null)){
                $intervalDiff = $dateHeureDebut->diff($rdvRecherche->getDateHeureDebut(), true);
                $this->diffTemps = $intervalDiff->h*60 + $intervalDiff->i;
            }
        }

    }
}

?>
