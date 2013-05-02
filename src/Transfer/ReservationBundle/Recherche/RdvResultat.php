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
class RdvResultat extends CreneauRdv
{
    private $diffTemps;
            
    public function getDiffTemps() {
        return $this->diffTemps;
    }

    public function setDiffTemps($diffTemps) {
        $this->diffTemps = $diffTemps;
    }
           
    public function __construct($creneauRdv = null, $rdvRecherche = null){
        if(!($creneauRdv ==null)){
            $this->id = $creneauRdv->getId();            
            $this->setDateHeureDebut($creneauRdv->getDateHeureDebut());        
            if(!($rdvRecherche == null)){
                $intervalDiff = $this->getDateHeureDebut()->diff($rdvRecherche->getDateHeureDebut(), true);
                $this->diffTemps = $intervalDiff->i;
            }
        }

    }
}

?>
