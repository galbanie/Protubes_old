<?php

/**
 * Description of Donnees
 *
 * @author galbanie
 */
class Donnees {
    
    protected static $instance = null;
    protected static $donnees = null;
    
    protected function __construct() {
        self::$donnees = array();
    }
    
    protected static function instancie(){
        if(self::$instance == null) self::$instance = new self;
    }

    public static function getInstance(){
        if(self::$instance == null) self::instancie ();
        return self::$instance;
    }

    public static function getDonnees(){
        if(self::$instance == null){
            self::instancie ();
        }
        return self::$donnees;
    }
    
    public static function resetDonnees(){
        self::$donnees = null;
        return self::$instance;
    }
    
    public static function ajouterValeur($valeur, $key = null){
        if(self::$instance == null) self::instancie ();
        if($key == null) self::$donnees[] = $valeur;
        else self::$donnees[$key] = $valeur;
        return self::$instance;
    }
    
    public static function supprimerValeur($key){
        if(self::$instance == null) self::instancie ();
        if(array_key_exists($key, self::$donnees)) unset (self::$donnees[$key]);
        return self::$instance;
    }
    
    public static function getValeur($key){
        if(self::$instance !== null){
            if(array_key_exists($key, self::$donnees)) return self::$donnees[$key];
        }
        return false;
    }

    public static function existeKey($key){
        if(self::$instance !== null){
            if(array_key_exists($key, self::$donnees)) return true;
        }
        return false;
    }
    
    public static function existeValeur($key, $valeur){
        if(self::$instance !== null){
            if(self::$donnees[$key] == $valeur) return true;
        }
        return false;
    }
}

?>
