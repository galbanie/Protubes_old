<?php

/**
 * Description of ControleurFactory
 *
 * @author galbanie
 */
class ControleurFactory {
    
    public static function getControleur($type = 'default'){
        $type = strtolower($type);
        switch ($type) {
            case 'search'  : return new ControleurSearch();
            case 'watch'   : return new ControleurWatch();
            case 'membre'  : return new ControleurMembre();
            case 'upload'  : return new ControleurUpload();
            case 'entity'  : return new ControleurEntity();
            case 'default' :
            default        : return new ControleurDefault();
        }
    }
}

?>
