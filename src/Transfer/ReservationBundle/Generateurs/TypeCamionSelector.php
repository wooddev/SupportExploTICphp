<?php

namespace Transfer\ReservationBundle\Generateurs;

/**
 * Description of typeCamionSelector
 *
 * @author Grumpf
 */
class TypeCamionSelector {
    //put your code here
    private $typeCamion;
    
    public function getTypeCamion() {
        return $this->typeCamion;
    }

    public function setTypeCamion(\Transfer\ReservationBundle\Entity\TypeCamion $typeCamion) {
        $this->typeCamion = $typeCamion;
    }


}

?>
