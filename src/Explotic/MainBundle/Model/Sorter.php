<?php
namespace Explotic\MainBundle\Model;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sorter
 *
 * @author Adrien Arraiolos
 */
class Sorter implements \Iterator
{
    protected $elements; // tableau d'objets
    private $position; // position du parcours (utilisé par foreach)
    private $sortGetterName; // getter de l'attribut d'objet utilisé pour trier
   
    function __construct(){
        $this->position = 0;
    }   
    ////////////////////////////////////////////
    // fonctions pour le tri des objets
    function cmp($a, $b){
        $criteria= $this->sortGetterName;
        if(  $a->$criteria() ==  $b->$criteria() ){ return 0 ; } 
        return ($a->$criteria() < $b->$criteria()) ? -1 : 1;
    }    
    function sortArray($sortGetterName){     
        $this->sortGetterName=$sortGetterName;
        usort($this->elements, array($this,'cmp'));
        return $this;
    }
    ///////////////////////////////////////////
    // Propriétés getter et setter
    public function getElements() {
        return $this->elements;
    }
    public function setElements($elements){
        $this->elements = $elements;
    }
    public function add($element){
        $this->elements[]=$element;
    }
    //////////////////////////////////////////////    
    // Interface iterator
    public function current() {
        return $this->elements[$this->position];
    }
    public function key() {
        return $this->position;
    }
    public function next() {
        ++$this->position;
        return $this->current();
    }
    public function rewind() {
        $this->position = 0;
        return $this->current();
    }
    public function valid() {
        return isset($this->elements[$this->position]);
    }    
    ///////////////////////////////////////////////
}

?>
