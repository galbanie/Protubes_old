<?php

/**
 * Description of DataBase
 * 
 * La classe DataBase utilise le pattern singleton.
 * Elle fournit une seul et même instance PDO.
 * Elle utilise la classe Config pour charger les paramètres
 * utiles à l'objet PDO.
 *
 * @author galbanie
 */
class DataBase {
    
    private static $instance = null;
    
    public static function instancie (){
        $config = Config::getConfig("bd_local");
        if(self::$instance === null ) self::$instance = new PDO($config['dsn'], $config['username'], $config['password']);
        return self::$instance;
    }
}

?>
