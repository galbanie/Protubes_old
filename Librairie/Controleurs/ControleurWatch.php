<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleurWatch
 *
 * @author galbanie
 */
class ControleurWatch extends Controleur{
    
    public function __construct() {
        
    }
    
    public function executerAction(){
        try{
            $this->genererVue('vueWatch');
        } catch(Exception $e){
            $this->genererVue('vueError');
        }
    }
}

?>
