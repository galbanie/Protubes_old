<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleurEntity
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */
class ControleurEntity extends Controleur {
    
    private $managerVideo;
    
    public function __construct() {
        $this->managerVideo = new VideoManager(DataBase::instancie());
    }
    
    public function executerAction() {
        try{
            //if (is_ajax()) {
                if (isset($_REQUEST["entity"]) && !empty($_REQUEST["entity"])) { //Checks if action value exists
                    $action = $_REQUEST["entity"];
                    switch($action) { //Switch case for value of action
                        case "video": $this->video_function(); break;
                    }
                }
            //}
        } catch (Exception $ex) {
            echo 'code : ' + $ex->getCode() + '<br />Message : ' + $ex->getMessage() + '<br />Trace : ' + $ex->getTraceAsString();
        }
    }
    
    //Function to check if the request is an AJAX request
    function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
 
    protected function video_function(){
        $return = array("nom" , "galbanie");

        //Do what you need to do with the info. The following are some examples.
        //if ($return["favorite_beverage"] == ""){
        //  $return["favorite_beverage"] = "Coke";
        //}
        //$return["favorite_restaurant"] = "McDonald's";

        //$return["json"] = json_encode($return);
        header('Content-type: application/json');
        echo json_encode($return);
    }
    
}
