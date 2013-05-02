<?php
namespace Transfer\ReservationBundle\Recherche;

use Transfer\ReservationBundle\Entity\CreneauRdv;
/**
 * Description of RdvRecherche
 *
 * Cette classe hérite de CréneauRdv
 * 
 *  --  Elle sert de support à construction du formulaire de recherche de créneau 
 * 
 * @author Adrien
 */
class RdvRecherche extends CreneauRdv
{
    private $typeCamion;

    public function getTypeCamion() {
        return $this->typeCamion;
    }

    public function setTypeCamion($typeCamion) {
        $this->typeCamion = $typeCamion;
    }


}

?>
