<?php
namespace Explotic\AgendaBundle\Model;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreneauAffiche
 *
 * @author arraiolosa
 */
class CreneauAffiche {
    /**
     * @var integer
     */
    private $id;


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
     * @var string
     */
    private $statutRdv;

    /**
     * @var \Explotic\AgendaBundle\Entity\CreneauRdv
     */
    private $creneauRdv;

    /**
     * Set statutRdv
     *
     * @param string $statutRdv
     * @return Rdv
     */
    public function setStatutRdv($statutRdv)
    {
        $this->statutRdv = $statutRdv;
    
        return $this;
    }

    /**
     * Get statutRdv
     *
     * @return string 
     */
    public function getStatutRdv()
    {
        return $this->statutRdv;
    }

    /**
     * Set creneauRdv
     *
     * @param \Explotic\AgendaBundle\Entity\CreneauRdv $creneauRdv
     * @return Rdv
     */
    public function setCreneauRdv(\Explotic\AgendaBundle\Entity\CreneauRdv $creneauRdv = null)
    {
        $this->creneauRdv = $creneauRdv;
    
        return $this;
    }

    /**
     * Get creneauRdv
     *
     * @return \Explotic\AgendaBundle\Entity\CreneauRdv 
     */
    public function getCreneauRdv()
    {
        return $this->creneauRdv;
    }

    /**
     * @var \Explotic\ProfilBundle\Entity\Transporteur
     */
    
        
    public function init($creneauRdv, $typeCamion){
        $this->setCreneauRdv($creneauRdv);                
        $this->setStatutRdv('provisoire');      
    }
   
    
    Public function getCreneauStructure(){
        return $this->getCreneauRdv();
    }
    public function getJour(){
        return $this->creneauRdv->getJour();
    }
    public function getAnnee(){
        return $this->creneauRdv->getAnnee();
    }
    public function getSemaine(){
        return $this->creneauRdv->getSemaine();
    }
    public function getDateHeureFin(){
        return $this->creneauRdv->getDateHeureFin();
    }
    public function getDateHeureDebut(){
        return $this->creneauRdv->getDateHeureDebut();
    }
    /**
     * @var \Explotic\AgendaBundle\Entity\TypeRdv
     */
    private $type;


    /**
     * Set type
     *
     * @param \Explotic\AgendaBundle\Entity\TypeRdv $type
     * @return Rdv
     */
    public function setType(\Explotic\AgendaBundle\Entity\TypeRdv $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return \Explotic\AgendaBundle\Entity\TypeRdv 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @var \Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;


    /**
     * Set calendrier
     *
     * @param \Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Rdv
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return \Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }
    
    private $nom;
    
    public function getNom() {
        return $this->nom;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
    }
    
    function __construct($rdv,$nom){
        $this->id = $rdv->getId();
        $this->statutRdv = $rdv->getStatutRdv();
        $this->creneauRdv = $rdv->getCreneauRdv();
        $this->type = $rdv->getType();
        $this->calendrier = $rdv->getCalendrier();
        $this->nom = $nom;
    }
}
?>
