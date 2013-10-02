<?php

/**
 * Description of Modele
 * Modele implemente le design pattern Observer.
 * Classe absaitre dont découle toutes les calsses
 * du modèle.
 *
 * @author galbanie<setrukmarcroger@gmail.com>
 */
abstract class Modele implements Observable{
    
    protected $_observers = array();
    protected $id = null;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id,$notify = false) {
        $this->id = $id;
        if($notify) $this->notifyObservers ();
    }

    public function setTableauDonnees(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
   
    public function attach(Observer $observer){
        $this->_observers[] = $observer;
        return $this;
    }
    
    public function detach(Observer $observer){
        if(is_int($key = array_search($observer, $this->_observers, true))){
            unset($this->_observers[$key]);
        }
        return $this;
    }
    
    public function notifyObservers(){
        foreach ($this->_observers as $observer){
            try{
                $observer->update($this);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
    }
    
    public function notify(Observer $observer, $arg = null){
        if(is_int($key = array_search($observer, $this->_observers, true))){
            $this->_observers[$key]->update($this, $arg);
        }
        return $this;
    }
}

?>
