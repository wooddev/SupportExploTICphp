<?php
namespace Transfer\ReservationBundle\Recherche;

use Transfer\ReservationBundle\Entity\CreneauRdv;
/**
 * Description of RdvRecherche
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

    public function __construct($creneauRdv, $rdvRecherche){
        $this->id = $creneauRdv->getId();
        $this->setDateHeureDebut($creneauRdv->getDateHeureDebut());
        $intervalDiff = $this->getDateHeureDebut()->diff($rdvRecherche->getDateHeureDebut(), true);
        $this->diffTemps = $intervalDiff->i;
    }
}

?>