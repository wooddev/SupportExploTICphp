<?php

namespace Explotic\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 */
class Rdv
{
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
    
        
    public function init($creneauRdv, $statutRdv, $options=null){
        $this->setCreneauRdv($creneauRdv);     
        $this->setStatutRdv($statutRdv);
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
    
}