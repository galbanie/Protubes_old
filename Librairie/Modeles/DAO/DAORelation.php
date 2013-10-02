<?php

/**
 * Description of DAORelation
 *
 * @author galbanie
 */
abstract class DAORelation implements Observer{
    /* @var $bd PDO */
    protected $bd = null; //instance de PDO
    
    public function setBd(&$bd) {
        $this->bd = $bd;
    }
    
    public abstract function update(Observable $subject, $arg = null);
}

?>
