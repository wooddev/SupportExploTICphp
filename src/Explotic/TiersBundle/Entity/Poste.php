<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Poste
 */
class Poste extends SiteIntervention
{
    /**
     * @var string $nomChantier
     */
    private $nomChantier;
    
        /**
     * @var \Explotic\TiersBundle\Entity\Stagiaire
     */
    private $stagiaire;

    /**
     * Set nomChantier
     *
     * @param string $nomChantier
     * @return Poste
     */
    public function setNomChantier($nomChantier)
    {
        $this->nomChantier = $nomChantier;
    
        return $this;
    }

    /**
     * Get nomChantier
     *
     * @return string 
     */
    public function getNomChantier()
    {
        return $this->nomChantier;
    }



    /**
     * Set stagiaire
     *
     * @param \Explotic\TiersBundle\Entity\Stagiaire $stagiaire
     * @return Poste
     */
    public function setStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaire = null)
    {
        $this->stagiaire = $stagiaire;
    
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
        if(!(null===$this->getNomChantier())&&!(null===$this->getStagiaire())){
            return $this->getNomChantier().' '.$this->getStagiaire()->getNom().' '.$this->getStagiaire()->getEntreprise()->getRaisonSociale();
        }
        return 'Chantier en cours de création';
    }
}