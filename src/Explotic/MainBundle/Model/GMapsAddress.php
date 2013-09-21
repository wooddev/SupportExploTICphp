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
    protected $route;
    protected $streetNumber;
    protected $city;
    protected $postalCode;
    protected $lat;
    protected $lon;
    
    public function getAddress(){
        return $this->address;
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
    public function getRoute() {
        return $this->route;
    }

    public function setRoute($route) {
        $this->route = $route;
    }

    public function getStreetNumber() {
        return $this->streetNumber;
    }

    public function setStreetNumber($streetNumber) {
        $this->streetNumber = $streetNumber;
    }

        public function autoAddress(){
        $this->setAddress = 
                $this->getStreetNumber()+' '+
                $this->getRoute()+', '+
                $this->getPostalCode()+' '+
                $this->getCity()
                ;
    }
}

?>
