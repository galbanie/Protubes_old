<?php

/**
 * Description of Crypteur
 *
 * @author galbanie
 */
final class Crypteur {
    
    private static $crypt = null;
    
    public static function getCrypteur(){
        $crypt = Config::getConfig('crypt');
        if(self::$crypt == null) return self::$crypt = new Crypt ($crypt['key']);
        return self::$crypt;
    }
}

?>
