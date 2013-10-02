<?php

/**
 * Description of Compte
 *
 * @author galbanie
 */
class Compte extends Modele{
    const CONFIDENTIALITE_PRIVATE = "private";
    const CONFIDENTIALITE_PUBLIC = "public";
    
    private $actif;
    private $newsletter;
    private $langueDefault;
    private $confidentialiteDefault;
    private $permettreRechercheMembre;
    private $idUsager;
    
    public function __construct($id = null, $actif = false,$newsletter = true,$langueDefault = "fr",$confidentialiteDefault = self::CONFIDENTIALITE_PUBLIC,$permettreRechercheMembre = true, $idUsager = null) {
        $this->setId($id);
        $this->setActif($actif);
        $this->setNewsletter($newsletter);
        $this->setLangueDefault($langueDefault);
        $this->setConfidentialiteDefault($confidentialiteDefault);
        $this->setPermettreRechercheMembre($permettreRechercheMembre);
        $this->setIdUsager($idUsager);
    }
    
    public function isActif() {
        return (boolean)$this->actif;
    }

    public function setActif($actif,$notify = false) {
        $this->actif = (boolean)$actif;
        if($notify) $this->notifyObservers ();
    }
    
    public function isNewsletter() {
        return (boolean)$this->newsletter;
    }

    public function setNewsletter($newsletter,$notify = false) {
        $this->newsletter = (boolean)$newsletter;
        if($notify) $this->notifyObservers ();
    }

    public function getLangueDefault() {
        return $this->langueDefault;
    }

    public function setLangueDefault($langueDefault,$notify = false) {
        if(mb_strlen($langueDefault,mb_internal_encoding()) == 2){
            $this->langueDefault = strtolower($langueDefault);
            if($notify) $this->notifyObservers ();
        }  
    }

    public function getConfidentialiteDefault() {
        return $this->confidentialiteDefault;
    }

    public function setConfidentialiteDefault($confidentialiteDefault,$notify = false) {
        $this->confidentialiteDefault = $confidentialiteDefault;
        if($notify) $this->notifyObservers ();
    }

    public function isPermettreRechercheMembre() {
        return (boolean)$this->permettreRechercheMembre;
    }

    public function setPermettreRechercheMembre($permettreRechercheMembre,$notify = false) {
        $this->permettreRechercheMembre = (boolean)$permettreRechercheMembre;
        if($notify) $this->notifyObservers ();
    }

    public function getIdUsager() {
        return $this->idUsager;
    }

    public function setIdUsager($idUsager,$notify = false) {
        $this->idUsager = $idUsager;
        if($notify) $this->notifyObservers ();
    }
    
}

?>