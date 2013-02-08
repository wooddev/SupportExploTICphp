<?php

namespace Transfer\ReservationBundle\Entity;

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
     * @var \Transfer\ReservationBundle\Entity\CreneauRdv
     */
    private $creneauRdv;

    /**
     * @var \Transfer\ReservationBundle\Entity\Transporteur
     */
    private $transporteurPlanif;

    /**
     * @var \Transfer\ReservationBundle\Entity\Poste
     */
    private $poste;

    /**
     * @var \Transfer\ReservationBundle\Entity\PlanningConfirm
     */
    private $planningConfirm;

    /**
     * @var \Transfer\ReservationBundle\Entity\PlanningProvisoire
     */
    private $planningProvisoire;


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
     * @param \Transfer\ReservationBundle\Entity\CreneauRdv $creneauRdv
     * @return Rdv
     */
    public function setCreneauRdv(\Transfer\ReservationBundle\Entity\CreneauRdv $creneauRdv = null)
    {
        $this->creneauRdv = $creneauRdv;
    
        return $this;
    }

    /**
     * Get creneauRdv
     *
     * @return \Transfer\ReservationBundle\Entity\CreneauRdv 
     */
    public function getCreneauRdv()
    {
        return $this->creneauRdv;
    }

    /**
     * Set transporteurPlanif
     *
     * @param \Transfer\ReservationBundle\Entity\Transporteur $transporteurPlanif
     * @return Rdv
     */
    public function setTransporteurPlanif(\Transfer\ReservationBundle\Entity\Transporteur $transporteurPlanif = null)
    {
        $this->transporteurPlanif = $transporteurPlanif;
    
        return $this;
    }

    /**
     * Get transporteurPlanif
     *
     * @return \Transfer\ReservationBundle\Entity\Transporteur 
     */
    public function getTransporteurPlanif()
    {
        return $this->transporteurPlanif;
    }

    /**
     * Set poste
     *
     * @param \Transfer\ReservationBundle\Entity\Poste $poste
     * @return Rdv
     */
    public function setPoste(\Transfer\ReservationBundle\Entity\Poste $poste = null)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return \Transfer\ReservationBundle\Entity\Poste 
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set planningConfirm
     *
     * @param \Transfer\ReservationBundle\Entity\PlanningConfirm $planningConfirm
     * @return Rdv
     */
    public function setPlanningConfirm(\Transfer\ReservationBundle\Entity\PlanningConfirm $planningConfirm = null)
    {
        $this->planningConfirm = $planningConfirm;
    
        return $this;
    }

    /**
     * Get planningConfirm
     *
     * @return \Transfer\ReservationBundle\Entity\PlanningConfirm 
     */
    public function getPlanningConfirm()
    {
        return $this->planningConfirm;
    }

    /**
     * Set planningProvisoire
     *
     * @param \Transfer\ReservationBundle\Entity\PlanningProvisoire $planningProvisoire
     * @return Rdv
     */
    public function setPlanningProvisoire(\Transfer\ReservationBundle\Entity\PlanningProvisoire $planningProvisoire = null)
    {
        $this->planningProvisoire = $planningProvisoire;
    
        return $this;
    }

    /**
     * Get planningProvisoire
     *
     * @return \Transfer\ReservationBundle\Entity\PlanningProvisoire 
     */
    public function getPlanningProvisoire()
    {
        return $this->planningProvisoire;
    }
}