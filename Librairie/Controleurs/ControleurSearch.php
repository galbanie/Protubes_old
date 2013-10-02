<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleurSearch
 *
 * @author galbanie
 */
class ControleurSearch extends Controleur{
    
    public function __construct() {
        
    }
    
    public function executerAction(){
        try{
            $this->genererVue('vueSearch');
        } catch(Exception $e){
            $this->genererVue('vueError');
        }
    }
}

?>
