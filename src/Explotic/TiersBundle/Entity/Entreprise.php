<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Entreprise
 */
class Entreprise
{    
    private $id;
    
    public function getId() {
        return $this->id;
    }
    
    private $gerant;
    /**
     * 
     * @return \Explotic\TiersBundle\Entity\Geran
     */
    public function getGerant() {
        return $this->gerant;
    }
    /**
     * 
     * @param \Explotic\TiersBundle\Entity\Gerant $gerant
     */
    public function setGerant(Gerant $gerant) {
        $this->gerant = $gerant;
    }

            

        /**
     * @var string $raisonSociale
     */
    private $raisonSociale;

    
   
    /**
     * @var Explotic\TiersBundle\Entity\Bureau
     */
    private $bureau;

    /**
     * @var Explotic\PlanningBundle\Entity\CreditTemps
     */
    private $creditTemps;

    
    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Entreprise
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
     * Set bureau
     *
     * @param Explotic\TiersBundle\Entity\Bureau $bureau
     * @return Entreprise
     */
    public function setBureau(\Explotic\TiersBundle\Entity\Bureau $bureau = null)
    {
        $this->bureau = $bureau;
    
        return $this;
    }

    /**
     * Get bureau
     *
     * @return Explotic\TiersBundle\Entity\Bureau 
     */
    public function getBureau()
    {
        return $this->bureau;
    }

    /**
     * Set creditTemps
     *
     * @param Explotic\PlanningBundle\Entity\CreditTemps $creditTemps
     * @return Entreprise
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
    
    public function __toString() {

        if(!$this->id){
            return 'Nouvelle entrée';
        }
        if (!$this->raisonSociale){
            return parent::__toString();
        }
        if(!is_object($this->getBureau())){
            return $this->getRaisonSociale();        
        } 
        return $this->getRaisonSociale().' '.$this->getBureau()->getLocalisation()->getCommune();

    }
    /**
     * @var string
     */
    private $siret;

    /**
     * @var string
     */
    private $ape;

    /**
     * @var string
     */
    private $cnil;

    /**
     * @var string
     */
    private $versionExplotic;

    /**
     * @var string
     */
    private $commentaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stagiaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $machines;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stagiaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->machines = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set siret
     *
     * @param string $siret
     * @return Entreprise
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    
        return $this;
    }

    /**
     * Get siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set ape
     *
     * @param string $ape
     * @return Entreprise
     */
    public function setApe($ape)
    {
        $this->ape = $ape;
    
        return $this;
    }

    /**
     * Get ape
     *
     * @return string 
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Set cnil
     *
     * @param string $cnil
     * @return Entreprise
     */
    public function setCnil($cnil)
    {
        $this->cnil = $cnil;
    
        return $this;
    }

    /**
     * Get cnil
     *
     * @return string 
     */
    public function getCnil()
    {
        return $this->cnil;
    }

    /**
     * Set versionExplotic
     *
     * @param string $versionExplotic
     * @return Entreprise
     */
    public function setVersionExplotic($versionExplotic)
    {
        $this->versionExplotic = $versionExplotic;
    
        return $this;
    }

    /**
     * Get versionExplotic
     *
     * @return string 
     */
    public function getVersionExplotic()
    {
        return $this->versionExplotic;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return Entreprise
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\stagiaire $stagiaires
     * @return Entreprise
     */
    public function addStagiaire(\Explotic\TiersBundle\Entity\stagiaire $stagiaires)
    {
        $this->stagiaires[] = $stagiaires;
    
        return $this;
    }

    /**
     * Remove stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\stagiaire $stagiaires
     */
    public function removeStagiaire(\Explotic\TiersBundle\Entity\stagiaire $stagiaires)
    {
        $this->stagiaires->removeElement($stagiaires);
    }

    /**
     * Get stagiaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStagiaires()
    {
        return $this->stagiaires;
    }

    /**
     * Add machines
     *
     * @param \Explotic\TiersBundle\Entity\Machine $machines
     * @return Entreprise
     */
    public function addMachine(\Explotic\TiersBundle\Entity\Machine $machines)
    {
        $this->machines[] = $machines;
    
        return $this;
    }

    /**
     * Remove machines
     *
     * @param \Explotic\TiersBundle\Entity\Machine $machines
     */
    public function removeMachine(\Explotic\TiersBundle\Entity\Machine $machines)
    {
        $this->machines->removeElement($machines);
    }

    /**
     * Get machines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMachines()
    {
        return $this->machines;
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $employesrecruteurs;


    /**
     * Add employesrecruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs
     * @return Entreprise
     */
    public function addEmployesrecruteur(\Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs)
    {
        $this->employesrecruteurs[] = $employesrecruteurs;
    
        return $this;
    }

    /**
     * Remove employesrecruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs
     */
    public function removeEmployesrecruteur(\Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs)
    {
        $this->employesrecruteurs->removeElement($employesrecruteurs);
    }

    /**
     * Get employesrecruteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployesrecruteurs()
    {
        return $this->employesrecruteurs;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $recruteurs;


    /**
     * Add recruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $recruteurs
     * @return Entreprise
     */
    public function addRecruteur(\Explotic\TiersBundle\Entity\Recruteur $recruteurs)
    {
        $this->recruteurs[] = $recruteurs;
    
        return $this;
    }

    /**
     * Remove recruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $recruteurs
     */
    public function removeRecruteur(\Explotic\TiersBundle\Entity\Recruteur $recruteurs)
    {
        $this->recruteurs->removeElement($recruteurs);
    }

    /**
     * Get recruteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecruteurs()
    {
        return $this->recruteurs;
    }

    
    
    /*
     * get MyMarkers
     * 
     * Retourne la collection de marker de la classe
     * 
     * @return \Explotic\MainBundle\Model\MyMarkers
     */
    
    public function getMyMarkers(){
        $markers = new \Explotic\MainBundle\Model\MyMarkers();
        $markers->setProfilName(get_class($this));
        // Récup du bureau
        if(!(null===$this->getBureau())){
            $bureau = new \Explotic\MainBundle\Model\MyMarker();        
            $bureau->setLat($this->getBureau()->getLocalisation()->getGeometry()->getLat());
            $bureau->setLon($this->getBureau()->getLocalisation()->getGeometry()->getLon());
            $bureau->setIcoPath('../bundles/exploticmain/images/workoffice.png');
            $bureau->setLabel('Bureau de l\'entreprise');
            $bureau->setComment($this->raisonSociale);
        
            $markers->addMarker($bureau);            
        }

        // Récup des postes des stagiaires
        
        if((!null===$this->getStagiaires())){
            if($this->getStagiaires()->count()>0){
                foreach($this->getStagiaires() as $stagiaire){
                    if(!(null===$stagiaire->getPoste()) && ($stagiaire->getPoste()->count()>0)){
                        foreach( $stagiaire->getPostes() as $poste) {
                            $posteM= new \Explotic\MainBundle\Model\MyMarker();
                            $posteM->setLat($poste->getLocalisation()->getGeometry()->getLat());
                            $posteM->setLon($poste->getLocalisation()->getGeometry()->getLon());
                            $posteM->setIcoPath('bundles/exploticmain/images/forest2.png');
                            $posteM->setLabel('Poste de travail');
                            $posteM->setComment('Chantier :'.$poste->getNomChantier().'<br>Stagiaire:'.$stagiaire->firstname.' '.$stagiaire->lastname);
                            $markers->addMarker($posteM);
                        }
                    }
                }
            }
        }
        
        return $markers;
        
    }
    
    /**
     * @var string
     */
    private $telephone;

    /**
     * @var string
     */
    private $email;


    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Entreprise
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Entreprise
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setStagiaires(\Doctrine\Common\Collections\Collection $stagiaires) {
        $this->stagiaires = $stagiaires;
    }

    public function setMachines(\Doctrine\Common\Collections\Collection $machines) {
        $this->machines = $machines;
    }

    public function setEmployesrecruteurs(\Doctrine\Common\Collections\Collection $employesrecruteurs) {
        $this->employesrecruteurs = $employesrecruteurs;
    }

    public function setRecruteurs(\Doctrine\Common\Collections\Collection $recruteurs) {
        $this->recruteurs = $recruteurs;
    }


}