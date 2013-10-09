<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Organisme
 */
class Organisme
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $raisonSociale
     */
    private $raisonSociale;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Organisme
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    
        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $formateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formateur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add formateur
     *
     * @param \Explotic\TiersBundle\Entity\Formateur $formateur
     * @return Organisme
     */
    public function addFormateur(\Explotic\TiersBundle\Entity\Formateur $formateur)
    {
        $this->formateur[] = $formateur;
    
        return $this;
    }

    /**
     * Remove formateur
     *
     * @param \Explotic\TiersBundle\Entity\Formateur $formateur
     */
    public function removeFormateur(\Explotic\TiersBundle\Entity\Formateur $formateur)
    {
        $this->formateur->removeElement($formateur);
    }

    /**
     * Get formateur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormateur()
    {
        return $this->formateur;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $salles;


    /**
     * Add salles
     *
     * @param \Explotic\TiersBundle\Entity\Salle $salles
     * @return Organisme
     */
    public function addSalle(\Explotic\TiersBundle\Entity\Salle $salles)
    {
        $this->salles[] = $salles;
    
        return $this;
    }

    /**
     * Remove salles
     *
     * @param \Explotic\TiersBundle\Entity\Salle $salles
     */
    public function removeSalle(\Explotic\TiersBundle\Entity\Salle $salles)
    {
        $this->salles->removeElement($salles);
    }

    /**
     * Get salles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalles()
    {
        return $this->salles;
    }
    
    public function setFormateur(\Doctrine\Common\Collections\Collection $formateur) {
        $this->formateur = $formateur;
    }

    public function setSalles(\Doctrine\Common\Collections\Collection $salles) {
        $this->salles = $salles;
    }

    public function __toString() {
        if($this->raisonSociale)
            return $this->raisonSociale;
        else
            return '-';
        
    } 
    
    public function getMyMarkers($paths){
        $markers = new \Explotic\MainBundle\Model\MyMarkers();
        $markers->setProfilName(get_class($this));

        // Récup des salles     

        if(!(null===$this->getSalles()) && (!$this->getSalles()->isEmpty())){
            foreach( $this->getSalles() as $salle) {
                $salleM= new \Explotic\MainBundle\Model\MyMarker();
                $salleM->setLat($salle->getLocalisation()->getGeometry()->getLat());
                $salleM->setLon($salle->getLocalisation()->getGeometry()->getLon());
                $salleM->setIcoPath($paths['salle']);
                $salleM->setLabel('Salle de formation');
                $salleM->setComment('Adresse :'.$salle->getAdresseRue().', '.$salle->getLocalisation()->getCommune());
                $markers->addMarker($salleM);
            }
        }        
        
        return $markers;
    
        
    }
}