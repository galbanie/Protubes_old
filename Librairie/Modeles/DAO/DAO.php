<?php

/**
 * Description of DAO
 *
 * @author galbanie
 */
abstract class DAO implements Observer{
    /* @var $bd PDO */
    protected $bd = null; //instance de PDO
    
    public function setBd(&$bd) {
        $this->bd = $bd;
    }
    
    public abstract function add($objet);
    
    public abstract function delete($colonne,$value);
    
    public abstract function get($colonne,$value);
    
    public abstract function getListAll();
    
    public abstract function getList($colonne,$value);

    public abstract function getListLimit($colonne,$value,$limitStart,$pagination);
    
    public abstract function getListAllLimit($limitStart,$pagination);
    
    public abstract function countRows();

    //public abstract function update(Observable $subject, $arg = null);


}

?>
