<?php
namespace Explotic\MainBundle\Model;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agenda
 *
 * @author arraiolosa
 */
class Agenda {
    //put your code here
    private $agendaYear;
    private $val;
    
    public function getAgendaYear(){
        return $this->agendaYear;
    }
    public function setAgendaYear($var){
        $this->agendaYear = $var;
        return $this;
    }
    
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
}

class AgendaYear{
    private $agendaWeek;
    private $val;
    
    public function getAgendaWeek(){
        return $this->agendaWeek;
    }
    public function setAgendaWeek($var){
        $this->agendaWeek = $var;
        return $this;
    }
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
}

class AgendaWeek{
    private $agendaDay;
    private $val;
    
    public function getAgendaDay(){
        return $this->agendaDay;
    }
    public function setAgendaDay($var){
        $this->agendaDay = $var;
        return $this;
    }
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
}

class AgendaDay{
    private $creneau;
    private $val;
    
    public function getCreneau(){
        return $this->creneau;
    }
    public function setCreneau($var){
        $this->creneau = $var;
        return $this;
    }
    
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
}

?>
