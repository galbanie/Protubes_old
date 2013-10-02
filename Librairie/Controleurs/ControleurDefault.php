<?php

/**
 * Description of ControleurDefault
 *
 * @author galbanie
 */
class ControleurDefault extends Controleur {
    
    public function __construct() {
        
    }
    
    public function executerAction(){
        try{
            $this->genererVue('vueDefault');
        } catch(Exception $e){
            $this->genererVue('vueError');
        }
    }
}

?>
