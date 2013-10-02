<?php

/**
 * Description of List
 *
 * @author galbanie
 */
class Liste implements Navigable {
    private $objets;
    private $position = -1;
    
    public function __construct() {
        $this->objets = array();
    }

    public function __destruct() {
        unset($this->objets);
    }
    
    public function add($objet){
        array_push($this->objets, $objet);
    }
    
    public function delete(){
        if (isset ($this->objets[$this->position])){
            unset($this->objets[$this->position]);
            return true;
        }
        return false;
    }
    
    public function get(){
        if(isset($this->objets[$this->position])) 
            return $this->objets[$this->position];
        return null;
    }

    public function first() {
        $this->position = 0;
    }

    public function last() {
        $this->position = $this->length()-1;
    }

    public function next() {
        if($this->hasNext()) $this->position++;
    }

    public function previous() {
        if($this->hasPrevious()) $this->position--;
    }
    
    public function length(){
        return count($this->objets);
    }

    public function hasNext() {
        if($this->position < $this->length()-1) return true;
        return false;
    }

    public function hasPrevious() {
        if($this->position > 0) return true;
        return false;
    }

}
?>
