<?php

namespace Explotic\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreneauModele
 */
class CreneauModele extends Creneau
{   
       
    public function init( $jour, $heure, $minute,$duree) 
    {    

        $this->setJour($jour);
        $this->setHeure($heure);    
        $this->setMinute($minute);
        $this->setDuree($duree);               
                
        $this->setHeureDebut(new \DateTime);

        $this->getHeureDebut()->setISODate(2000,1,$jour);
        $this->getHeureDebut()->setTime($heure, $minute, 0);

        $this->setHeureFin(clone $this->getHeureDebut());        
        //ajout de la durée du créneau à heurefin
        //(utilisation des fonctions natives de php sur les objets DateTime)
        $this->getHeureFin()->add(\DateInterval::createFromDateString($duree.' minutes'));
        
        return $this;
    } 
    
    public function __toString() {
        return $this->getJour().'-'
                .$this->getHeure().':'
                .$this->getMinute().'-'
                .$this->getDuree().' min /';
    }

}