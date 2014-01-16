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
    
    /**
     * @var string $numero
     */
    private $numero;   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionHasInterventionEntreprises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionHasInterventionSalles = new \Doctrine\Common\Collections\ArrayCollection();
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
    
    public function getModuleNom(){
        if (!(null === $this->interventionEntreprise)){
            $this->interventionEntreprise->getModule()->getNom();            
        }
        elseif (!(null === $this->interventionSalle)){
            $this->interventionSalle->getModule()->getNom();            
        }        
    }
    /**
     * @var \DateTime
     */
    private $dateDebut;

    /**
     * @var \Explotic\FormationBundle\Entity\Module
     */
    private $module;


    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Session
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set module
     *
     * @param \Explotic\FormationBundle\Entity\Module $module
     * @return Session
     */
    public function setModule(\Explotic\FormationBundle\Entity\Module $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return \Explotic\FormationBundle\Entity\Module 
     */
    public function getModule()
    {
        return $this->module;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sessionHasInterventionSalles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sessionHasInterventionEntreprises;


    /**
     * Add sessionHasInterventionSalles
     *
     * @param \Explotic\PlanningBundle\Entity\SessionHasInterventionSalle $sessionHasInterventionSalles
     * @return Session
     */
    public function addSessionHasInterventionSalle(\Explotic\PlanningBundle\Entity\SessionHasInterventionSalle $sessionHasInterventionSalles)
    {
        $this->sessionHasInterventionSalles->add($sessionHasInterventionSalles);
    
        return $this;
    }

    /**
     * Remove sessionHasInterventionSalles
     *
     * @param \Explotic\PlanningBundle\Entity\SessionHasInterventionSalle $sessionHasInterventionSalles
     */
    public function removeSessionHasInterventionSalle(\Explotic\PlanningBundle\Entity\SessionHasInterventionSalle $sessionHasInterventionSalles)
    {
        $this->sessionHasInterventionSalles->removeElement($sessionHasInterventionSalles);
    }

    /**
     * Get sessionHasInterventionSalles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSessionHasInterventionSalles()
    {
        return $this->sessionHasInterventionSalles;
    }

    /**
     * Add sessionHasInterventionEntreprises
     *
     * @param \Explotic\PlanningBundle\Entity\SessionHasInterventionEntreprise $sessionHasInterventionEntreprises
     * @return Session
     */
    public function addSessionHasInterventionEntreprise(\Explotic\PlanningBundle\Entity\SessionHasInterventionEntreprise $sessionHasInterventionEntreprises)
    {
        $this->sessionHasInterventionEntreprises->add($sessionHasInterventionEntreprises);
    
        return $this;
    }

    /**
     * Remove sessionHasInterventionEntreprises
     *
     * @param \Explotic\PlanningBundle\Entity\SessionHasInterventionEntreprise $sessionHasInterventionEntreprises
     */
    public function removeSessionHasInterventionEntreprise(\Explotic\PlanningBundle\Entity\SessionHasInterventionEntreprise $sessionHasInterventionEntreprises)
    {
        $this->sessionHasInterventionEntreprises->removeElement($sessionHasInterventionEntreprises);
    }

    /**
     * Get sessionHasInterventionEntreprises
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSessionHasInterventionEntreprises()
    {
        return $this->sessionHasInterventionEntreprises;
    }
}