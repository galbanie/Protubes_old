<?php

/**
 * Description of Language
 *
 * @author galbanie
 */
final class Language {
    
    public static function getLangueServer(){
        $langues = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
        $languesConfig = array("en","fr");
        $langue = "fr";
        
        /*var_dump($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
        var_dump($langues);*/
        
        
        for($i = 0; (($i < count($langues))&&(!isset($langues))); $i++){
            if(in_array($langues[$i], $languesConfig)) $langue = $langues[$i];
        }
        return $langue;
    }
}

?>
