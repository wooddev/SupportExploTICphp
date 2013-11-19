<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Stagiaire
 */
class Stagiaire extends \Explotic\AdminBundle\Entity\User
{
    
    public function __toString() {
        if($this->getLastname() && $this->getFirstname()){
            return $this->getLastname().' '.$this->getFirstname().' - '.$this->getEntreprise();
        }
        if($this->getUsername()){
            return $this->getUsername().' - '.$this->getEntreprise();
        }
        return '-';
    }
    /**
     * @var boolean $marchePiedInfo
     */
    private $marchePiedInfo;


    /**
     * @var string $opca
     */
    private $opca;

    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;

    /**
     * @var Explotic\PlanningBundle\Entity\CreditTemps
     */
    private $creditTemps;

    /**
     * @var Explotic\TiersBundle\Entity\Entreprise
     */
    private $entreprise;

    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $postes;


    /**
     * Constructor
     */
    public function __construct()
    {   parent::__construct();    
        $this->addRole('ROLE_STAGIAIRE');
        $this->postes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->programmes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calendrier = new \Explotic\PlanningBundle\Entity\Calendrier();
        $this->interventionHasStagiaires =  new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * Set marchePiedInfo
     *
     * @param boolean $marchePiedInfo
     * @return Stagiaire
     */
    public function setMarchePiedInfo($marchePiedInfo)
    {
        $this->marchePiedInfo = $marchePiedInfo;
    
        return $this;
    }

    /**
     * Get marchePiedInfo
     *
     * @return boolean 
     */
    public function getMarchePiedInfo()
    {
        return $this->marchePiedInfo;
    }

    
    /**
     * Set opca
     *
     * @param string $opca
     * @return Stagiaire
     */
    public function setOpca($opca)
    {
        $this->opca = $opca;
    
        return $this;
    }

    /**
     * Get opca
     *
     * @return string 
     */
    public function getOpca()
    {
        return $this->opca;
    }

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Stagiaire
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }

    /**
     * Set creditTemps
     *
     * @param Explotic\PlanningBundle\Entity\CreditTemps $creditTemps
     * @return Stagiaire
     */
    public function setCreditTemps(\Explotic\PlanningBundle\Entity\CreditTemps $creditTemps = null)
    {
        $this->creditTemps = $creditTemps;
    
        return $this;
    }

    /**
     * Get creditTemps
     *
     * @return Explotic\PlanningBundle\Entity\CreditTemps 
     */
    public function getCreditTemps()
    {
        return $this->creditTemps;
    }

    /**
     * Set entreprise
     *
     * @param Explotic\TiersBundle\Entity\Entreprise $entreprise
     * @return Stagiaire
     */
    public function setEntreprise(\Explotic\TiersBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;
    
        return $this;
    }

    /**
     * Get entreprise
     *
     * @return Explotic\TiersBundle\Entity\Entreprise 
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    
    
    /**
     * Add postes
     *
     * @param \Explotic\TiersBundle\Entity\Poste $postes
     * @return Stagiaire
     */
    public function addPoste(\Explotic\TiersBundle\Entity\Poste $postes)
    {
        $this->postes[] = $postes;
    
        return $this;
    }

    /**
     * Remove postes
     *
     * @param \Explotic\TiersBundle\Entity\Poste $postes
     */
    public function removePoste(\Explotic\TiersBundle\Entity\Poste $postes)
    {
        $this->postes->removeElement($postes);
    }

    /**
     * Get postes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostes()
    {
        return $this->postes;
    }


    public function setPostes(\Doctrine\Common\Collections\Collection $postes) {
        $this->postes = $postes;
    }

    public function setProgrammes(\Doctrine\Common\Collections\Collection $programmes) {
        $this->programmes = $programmes;
    }

        
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $programmes;


    /**
     * Add programmes
     *
     * @param \Explotic\FormationBundle\Entity\Programme $programmes
     * @return Stagiaire
     */
    public function addProgramme(\Explotic\FormationBundle\Entity\Programme $programmes)
    {
        $this->programmes[] = $programmes;
    
        return $this;
    }

    /**
     * Remove programmes
     *
     * @param \Explotic\FormationBundle\Entity\Programme $programmes
     */
    public function removeProgramme(\Explotic\FormationBundle\Entity\Programme $programmes)
    {
        $this->programmes->removeElement($programmes);
    }

    /**
     * Get programmes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgrammes()
    {
        return $this->programmes;
    }
    /**
     * @var boolean
     */
    private $gerant;

    /**
     * @var string
     */
    private $forfaitTelephone;

    /**
     * @var string
     */
    private $niveauInfo;

    /**
     * @var string
     */
    private $typeEmploi;

    /**
     * @var string
     */
    private $commentaire;

    /**
     * @var \Explotic\TiersBundle\Entity\Machine
     */
    private $machine;


    /**
     * Set gerant
     *
     * @param boolean $gerant
     * @return Stagiaire
     */
    public function setGerant($gerant)
    {
        $this->gerant = $gerant;
    
        return $this;
    }

    /**
     * Get gerant
     *
     * @return boolean 
     */
    public function getGerant()
    {
        return $this->gerant;
    }

    /**
     * Set forfaitTelephone
     *
     * @param string $forfaitTelephone
     * @return Stagiaire
     */
    public function setForfaitTelephone($forfaitTelephone)
    {
        $this->forfaitTelephone = $forfaitTelephone;
    
        return $this;
    }

    /**
     * Get forfaitTelephone
     *
     * @return string 
     */
    public function getForfaitTelephone()
    {
        return $this->forfaitTelephone;
    }

    /**
     * Set niveauInfo
     *
     * @param string $niveauInfo
     * @return Stagiaire
     */
    public function setNiveauInfo($niveauInfo)
    {
        $this->niveauInfo = $niveauInfo;
    
        return $this;
    }

    /**
     * Get niveauInfo
     *
     * @return string 
     */
    public function getNiveauInfo()
    {
        return $this->niveauInfo;
    }

    /**
     * Set typeEmploi
     *
     * @param string $typeEmploi
     * @return Stagiaire
     */
    public function setTypeEmploi($typeEmploi)
    {
        $this->typeEmploi = $typeEmploi;
    
        return $this;
    }

    /**
     * Get typeEmploi
     *
     * @return string 
     */
    public function getTypeEmploi()
    {
        return $this->typeEmploi;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Stagiaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set machine
     *
     * @param \Explotic\TiersBundle\Entity\Machine $machine
     * @return Stagiaire
     */
    public function setMachine(\Explotic\TiersBundle\Entity\Machine $machine = null)
    {
        $this->machine = $machine;
    
        return $this;
    }

    /**
     * Get machine
     *
     * @return \Explotic\TiersBundle\Entity\Machine 
     */
    public function getMachine()
    {
        return $this->machine;
    }
    /**
     * @var \Explotic\TiersBundle\Entity\Recruteur
     */
    private $recruteur;


    /**
     * Set recruteur
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $recruteur
     * @return Stagiaire
     */
    public function setRecruteur(\Explotic\TiersBundle\Entity\Recruteur $recruteur = null)
    {
        $this->recruteur = $recruteur;
    
        return $this;
    }

    /**
     * Get recruteur
     *
     * @return \Explotic\TiersBundle\Entity\Recruteur 
     */
    public function getRecruteur()
    {
        return $this->recruteur;
    }

    
      /*
     * get MyMarkers
     * 
     * Retourne la collection de marker de la classe
     * 
     * @return \Explotic\MainBundle\Model\MyMarkers
     */
    
    public function getMyMarkers($paths){
        $markers = new \Explotic\MainBundle\Model\MyMarkers();
        $markers->setProfilName(get_class($this));
        // Récup du bureau
        if($this->getEntreprise() && $this->getEntreprise()->getBureau()){
            $bureau = new \Explotic\MainBundle\Model\MyMarker();        
            $bureau->setLat($this->getEntreprise()->getBureau()->getLocalisation()->getGeometry()->getLat());
            $bureau->setLon($this->getEntreprise()->getBureau()->getLocalisation()->getGeometry()->getLon());
            $bureau->setIcoPath($paths['bureau']);
            $bureau->setLabel('Bureau de l\'entreprise');
            $bureau->setComment($this->getEntreprise()->getRaisonSociale());
        
            $markers->addMarker($bureau);            
        }

        // Récup des postes du stagiaire       

        if(!(null===$this->getPostes()) && ($this->getPostes()->count()>0)){
            foreach( $this->getPostes() as $poste) {
                $posteM= new \Explotic\MainBundle\Model\MyMarker();
                $posteM->setLat($poste->getLocalisation()->getGeometry()->getLat());
                $posteM->setLon($poste->getLocalisation()->getGeometry()->getLon());
                $posteM->setIcoPath($paths['poste']);
                $posteM->setLabel('Poste de travail');
                $posteM->setComment('Chantier :'.$poste->getLabel());
                $markers->addMarker($posteM);
            }
        }        
        
        return $markers;
    }
        
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $interventionHasStagiaires;


    /**
     * Add interventionHasStagiaires
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires
     * @return Stagiaire
     */
    public function addInterventionHasStagiaire(\Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires)
    {
        $this->interventionHasStagiaires->add($interventionHasStagiaires);
    
        return $this;
    }

    /**
     * Remove interventionHasStagiaires
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires
     */
    public function removeInterventionHasStagiaire(\Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires)
    {
        $this->interventionHasStagiaires->removeElement($interventionHasStagiaires);
    }

    /**
     * Get interventionHasStagiaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterventionHasStagiaires()
    {
        return $this->interventionHasStagiaires;
    }
}