<?php
namespace Explotic\MainBundle\Model;

/**
 * Description of GMapsAddress
 *
 * @author arraiolosa
 */
class GMapsAddress
{
    //put your code here
    protected $address;
    protected $street;
    protected $city;
    protected $postalCode;
    protected $lat;
    protected $lon;
    
    public function getAddress(){
        return $this->address;
    }
    public function getStreet(){
        // recherche de la position du code postal dans la chaine address
        if (isset($this->postalCode)){
            $pos1 = strripos($this->address,$this->postalCode)-2;   //-2 >> pour supprimer la virgule et l'espace avant      
        }else {$pos1 = strlen($this->address)-6;}                   // -6 >> pour supprimer France
        // recherche de la position de la ville dans la chaine address
        if (isset($this->city)){
            $pos2 = strripos($this->address,$this->city)-2;
        }else {$pos2 = strlen($this->address)-6;}
        // définition de la position de césure de chaine >> on prend la position la plus petite
        $pos=$pos1;
        if($pos1>$pos2){
            $pos=$pos2;
        }            
        $this->street = substr($this->address,0,$pos); 
        return $this->street;
    }
    public function getCity(){
        return $this->city;
    }
    public function getPostalCode(){
        return $this->postalCode;
    }
    public function getLat(){
        return $this->lat;
    }
    public function getLon(){
        return $this->lon;
    }
    public function setAddress($p){
        $this->address=$p;
        return $this;
    }
    public function setStreet($p){
        $this->street=$p;
        return $this;
    }
    public function setCity($p){
        $this->city=$p;
        return $this;
    }
    public function setPostalCode($p){
        $this->postalCode=$p;
        return $this;
    }
    public function setLat($lat){
        $this->lat=$lat;
        return $this;
    }
    public function setLon($lon){
        $this->lon=$lon;
        return $this;
    }
    
    public function autoAddress(){
        $this->setAddress = 
                $this->getStreet()+' '+
                $this->getCity()+' '+
                $this->getPostalCode();
    }
}

?>
