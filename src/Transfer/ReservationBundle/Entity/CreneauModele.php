<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 

/**
 * CreneauModele
 */
class CreneauModele extends Creneau
{
        
    public function init($disponibilite, $jour, $heure,
            $minute,$duree,
            \Transfer\ReservationBundle\Entity\TypePoste $typePoste) 
    {    
        $this->setDisponibilite($disponibilite);
        $this->setJour($jour);
        $this->setHeure($heure);    
        $this->setMinute($minute);
        $this->setDuree($duree);

        $this->setTypePoste($typePoste);     
                         
        $this->setHeureDebut(new \DateTime);
        $this->setHeureFin(new \DateTime);
        
        $this->getHeureDebut()->setTime($heure, $minute, 0);
        $fin= $heure*60+$minute+$duree;
        $heureFin=floor($fin/60);
        $minuteFin=$fin-$heureFin;
        $this->getHeureFin()->setTime($heureFin,$minuteFin,0);           
    }    
    
    
    
}