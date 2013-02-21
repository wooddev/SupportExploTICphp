<?php
namespace Explotic\MainBundle\Model;

/**
 * Description of GMapsPoint
 *
 * @author arraiolosa
 */
class GMapsPoint
{
    //put your code here
    protected $lat;
    protected $lon;
    
    public function getLat(){
        return $this->lat;
    }
    public function getLon(){
        return $this->lon;
    }
    public function setLat($lat){
        $this->lat=$lat;
        return $this;
    }
    public function setLon($lon){
        $this->lon=$lon;
        return $this;
    }
}

?>
