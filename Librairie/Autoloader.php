<?php


/**
 * Description of Autoloader
 *
 * @author galbanie
 */
class Autoloader {
    // ajout du répertoire parent (Librairie/) à l'include path
    public function __construct() {
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/..'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Configuration'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Interfaces'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Outils'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Outils/PHPMailer'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Controleurs'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Modeles/Classes'));
        set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/Modeles/DAO'));
        spl_autoload_register(array('Autoloader','autoload'));
    }
    
    public function autoload($className){
        require_once str_replace('_','/',$className).'.php';
    }
}

?>
