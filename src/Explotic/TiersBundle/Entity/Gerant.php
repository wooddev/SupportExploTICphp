<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Gerant
 */
class Gerant extends \Explotic\AdminBundle\Entity\User
{    
    
    public function __construct() {
        parent::__construct();
        $this->addRole('ROLE_GERANT');
    }
    private $commentaires;
    
    public function getCommentaires() {
        return $this->commentaires;
    }

    public function setCommentaires($commentaires) {
        $this->commentaires = $commentaires;
    }
    
    private $entreprise;
    /**
     *
     * @return \Explotic\TiersBundle\Entity\Entreprise
     */
    public function getEntreprise() {
        return $this->entreprise;
    }
    /**
     * 
     * @param \Explotic\TiersBundle\Entity\Entreprise $entreprise
     */
    public function setEntreprise(Entreprise $entreprise) {
        $this->entreprise = $entreprise;
    }




            
    
}