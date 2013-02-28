<?php
namespace Explotic\MainBundle\Model;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyMarkers
 *
 * @author arraiolosa
 */
class MyMarkers {
    //put your code here
    private $profilName;
    private $markers;
    
    public function __construct()
    {        
        $this->markers  = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function setProfilName($var){
        $this->profilName = $var;
        return $this;
    }
    public function getProfilName(){
        return $this->profilName;
    }
    
    public function getMarkers(){
        return $this->markers;
    }
    
    public function addMarker($marker){
        $this->markers->add($marker);
        return $this;
    }
    
}

?>
