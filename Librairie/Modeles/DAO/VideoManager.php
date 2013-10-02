<?php

/**
 * Description of VideoManager
 *
 * @author galbanie
 */
class VideoManager extends DAO {
    
    function __construct(PDO $bd) {
        $this->setBd($bd);
    }

    public function add($objet) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function countRows() {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function delete($colonne, $value) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function get($colonne, $value) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getList($colonne, $value) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getListAll() {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getListAllLimit($limitStart, $pagination) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getListLimit($colonne, $value, $limitStart, $pagination) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function update(Observable $subject, $arg = null) {
        try {
            
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}

?>
