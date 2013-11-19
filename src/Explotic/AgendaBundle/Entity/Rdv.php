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
    protected $id;


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
    protected $statutRdv;

    /**
     * @var \Explotic\AgendaBundle\Entity\CreneauRdv
     */
    protected $creneauRdv;

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
    
        
    public function init($creneauRdv, $statutRdv, $agenda,$options=null){
        $this->setCreneauRdv($creneauRdv);     
        $this->setStatutRdv($statutRdv);
        $this->setAgenda($agenda);
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
     * @var \Explotic\AgendaBundle\Entity\Agenda
     */
    protected $agenda;


    /**
     * Set agenda
     *
     * @param \Explotic\AgendaBundle\Entity\Agenda $agenda
     * @return Rdv
     */
    public function setAgenda(\Explotic\AgendaBundle\Entity\Agenda $agenda = null)
    {
        $this->agenda = $agenda;
    
        return $this;
    }

    /**
     * Get agenda
     *
     * @return \Explotic\AgendaBundle\Entity\Agenda 
     */
    public function getAgenda()
    {
        return $this->agenda;
    }
}