<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Poste
 */
class Poste extends SiteIntervention
{

    
        /**
     * @var \Explotic\TiersBundle\Entity\Stagiaire
     */
    private $stagiaire;


    /**
     * Set stagiaire
     *
     * @param \Explotic\TiersBundle\Entity\Stagiaire $stagiaire
     * @return Poste
     */
    public function setStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaire = null)
    {
        $this->stagiaire = $stagiaire;
        $this->setCalendrier()->setLabel($this->label.'/'.$this->getStagiaire()->__toString());
        return $this;
    }

    /**
     * Get stagiaire
     *
     * @return \Explotic\TiersBundle\Entity\Stagiaire 
     */
    public function getStagiaire()
    {
        return $this->stagiaire;
    }
    
    public function __toString() {
        if(!(null===$this->getLabel())&&!(null===$this->getStagiaire())){
            return $this->getLabel().' '.$this->getStagiaire()->getNom().' '.$this->getStagiaire()->getEntreprise()->getRaisonSociale();
        }
        return 'Chantier en cours de création';
    }
}