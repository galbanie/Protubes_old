<?php

/**
 * Description of Commentaire
 *
 * @author galbanie
 */
class Commentaire extends Modele implements Appreciable{
    private $datePublication;
    private $message;
    private $valide = false;
    
    function __construct($datePublication = "",$message = "") {
        $this->setDatePublication($datePublication);
        $this->setMessage($message);
    }

    public function getDatePublication() {
        return $this->datePublication;
    }

    public function setDatePublication($datePublication,$notify = false) {
        $this->datePublication = $datePublication;
        if($notify) $this->notifyObservers ();
    }
    
    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message,$notify = false) {
        $this->message = $message;
        if($notify) $this->notifyObservers ();
    }
    
    public function isActif() {
        return $this->valide;
    }

    public function setActif($valide,$notify = false) {
        $this->valide = (boolean)$valide;
        if($notify) $this->notifyObservers ();
    }

    public function jaime($idUsager) {
        
    }

    public function jaimePas($idUsager) {
        
    }

    public function annuler($idUsager) {
        
    }

}

?>
