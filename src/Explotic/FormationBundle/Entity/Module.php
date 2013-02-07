<?php

namespace Explotic\FormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\FormationBundle\Entity\Module
 */
class Module
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var string $tarif
     */
    private $tarif;


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
     * Set nom
     *
     * @param string $nom
     * @return Module
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     * @return Module
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    
        return $this;
    }

    /**
     * Get tarif
     *
     * @return string 
     */
    public function getTarif()
    {
        return $this->tarif;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $interventionSalles;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $interventionEntreprises;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $programmes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->interventionSalles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->interventionEntreprises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->programmes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add interventionSalles
     *
     * @param Explotic\FormationBundle\Entity\InterventionSalle $interventionSalles
     * @return Module
     */
    public function addInterventionSalle(\Explotic\FormationBundle\Entity\InterventionSalle $interventionSalles)
    {
        $this->interventionSalles[] = $interventionSalles;
    
        return $this;
    }

    /**
     * Remove interventionSalles
     *
     * @param Explotic\FormationBundle\Entity\InterventionSalle $interventionSalles
     */
    public function removeInterventionSalle(\Explotic\FormationBundle\Entity\InterventionSalle $interventionSalles)
    {
        $this->interventionSalles->removeElement($interventionSalles);
    }

    /**
     * Get interventionSalles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInterventionSalles()
    {
        return $this->interventionSalles;
    }

    /**
     * Add interventionEntreprises
     *
     * @param Explotic\FormationBundle\Entity\InterventionEntreprise $interventionEntreprises
     * @return Module
     */
    public function addInterventionEntreprise(\Explotic\FormationBundle\Entity\InterventionEntreprise $interventionEntreprises)
    {
        $this->interventionEntreprises[] = $interventionEntreprises;
    
        return $this;
    }

    /**
     * Remove interventionEntreprises
     *
     * @param Explotic\FormationBundle\Entity\InterventionEntreprise $interventionEntreprises
     */
    public function removeInterventionEntreprise(\Explotic\FormationBundle\Entity\InterventionEntreprise $interventionEntreprises)
    {
        $this->interventionEntreprises->removeElement($interventionEntreprises);
    }

    /**
     * Get interventionEntreprises
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInterventionEntreprises()
    {
        return $this->interventionEntreprises;
    }

    /**
     * Add programmes
     *
     * @param Explotic\FormationBundle\Entity\Programme $programmes
     * @return Module
     */
    public function addProgramme(\Explotic\FormationBundle\Entity\Programme $programmes)
    {
        $this->programmes[] = $programmes;
    
        return $this;
    }

    /**
     * Remove programmes
     *
     * @param Explotic\FormationBundle\Entity\Programme $programmes
     */
    public function removeProgramme(\Explotic\FormationBundle\Entity\Programme $programmes)
    {
        $this->programmes->removeElement($programmes);
    }

    /**
     * Get programmes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProgrammes()
    {
        return $this->programmes;
    }
    
    public function __toString()
    {
        return $this->nom;
    }
}