<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleUpdate
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */
class ControleUpdate {
    static $content = array();
    
    static function add($value,$key){
        self::$content[$key] = $value;
    }
    
    static function get($key){
        return (in_array($key, self::$content))?self::$content[$key]: false;
    }
    
    static function delete($key){
        if (in_array($key, self::$content)) {
            unset(self::$content[$key]);
        }
    }
    
    static function has($key){
        return (in_array($key, self::$content))?true: false;
    }
    
    static function clear(){
        self::$content = array();
    }
}
