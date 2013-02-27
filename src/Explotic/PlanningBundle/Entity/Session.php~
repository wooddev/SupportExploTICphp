<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\PlanningBundle\Entity\Session
 */
class Session
{
    /**
     * @var integer $id
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
    
    public function getDateDebut()
    {
        $dateDebut = "01/01/2001";
        return $dateDebut;
    }
    /**
     * @var string $numero
     */
    private $numero;

    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;



    /**
     * @var Explotic\FormationBundle\Entity\Intervention
     */
    private $intervention;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $stagiaires;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $formateurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stagiaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set numero
     *
     * @param string $numero
     * @return Session
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Session
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
     * Set intervention
     *
     * @param Explotic\FormationBundle\Entity\Intervention $intervention
     * @return Session
     */
    public function setIntervention(\Explotic\FormationBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return Explotic\FormationBundle\Entity\Intervention 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Add stagiaires
     *
     * @param Explotic\TiersBundle\Entity\Stagiaire $stagiaires
     * @return Session
     */
    public function addStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaires)
    {
        $this->stagiaires[] = $stagiaires;
    
        return $this;
    }

    /**
     * Remove stagiaires
     *
     * @param Explotic\TiersBundle\Entity\Stagiaire $stagiaires
     */
    public function removeStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaires)
    {
        $this->stagiaires->removeElement($stagiaires);
    }

    /**
     * Get stagiaires
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStagiaires()
    {
        return $this->stagiaires;
    }

    /**
     * Add formateurs
     *
     * @param Explotic\TiersBundle\Entity\Formateur $formateurs
     * @return Session
     */
    public function addFormateur(\Explotic\TiersBundle\Entity\Formateur $formateurs)
    {
        $this->formateurs[] = $formateurs;
    
        return $this;
    }

    /**
     * Remove formateurs
     *
     * @param Explotic\TiersBundle\Entity\Formateur $formateurs
     */
    public function removeFormateur(\Explotic\TiersBundle\Entity\Formateur $formateurs)
    {
        $this->formateurs->removeElement($formateurs);
    }

    /**
     * Get formateurs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFormateurs()
    {
        return $this->formateurs;
    }
    /**
     * @var \Explotic\TiersBundle\Entity\Salle
     */
    private $salle;

    /**
     * @var \Explotic\TiersBundle\Entity\Poste
     */
    private $poste;


    /**
     * Set salle
     *
     * @param \Explotic\TiersBundle\Entity\Salle $salle
     * @return Session
     */
    public function setSalle(\Explotic\TiersBundle\Entity\Salle $salle = null)
    {
        $this->salle = $salle;
    
        return $this;
    }

    /**
     * Get salle
     *
     * @return \Explotic\TiersBundle\Entity\Salle 
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set poste
     *
     * @param \Explotic\TiersBundle\Entity\Poste $poste
     * @return Session
     */
    public function setPoste(\Explotic\TiersBundle\Entity\Poste $poste = null)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return \Explotic\TiersBundle\Entity\Poste 
     */
    public function getPoste()
    {
        return $this->poste;
    }
}