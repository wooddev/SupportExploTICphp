<?php
namespace Explotic\MainBundle\Model;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyMarker
 *
 * @author arraiolosa
 */
class MyMarker {
    //put your code here
    private $lat;
    private $lon;
    private $icoPath;
    private $label;
    private $comment;
    
    public function setLat($var){
        $this->lat = $var;
        return $this;
    }    
    public function getLat(){
        return $this->lat;
    }
    
    public function setLon($var){
        $this->lon = $var;
        return $this;
    }    
    public function getLon(){
        return $this->lon;
    }
    
    public function setIcoPath($var){
        $this->icoPath = $var;
        return $this;
    }    
    public function getIcoPath(){
        return $this->icoPath;
    }
    
    public function setLabel($var){
        $this->label = $var;
        return $this;
    }    
    public function getLabel(){
        return $this->label;
    }
    
    public function setComment($var){
        $this->comment = $var;
        return $this;
    }    
    public function getComment(){
        return $this->comment;
    }
}

?>
