<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppreciationManager
 *
 * @author galbanie
 */
class AppreciationManager extends DAORelation{
    
    public function __construct(PDO $bd) {
        $this->setBd($bd);
    }
    
    public function countRows($type) {
        try {
            $type = $this->checkType($type);
            if(!$type) return false;
            $requete = $this->bd->query("SELECT COUNT(*) AS nb_total FROM appreciation$type");
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $rows = (int)$resultat['nb_total'];
            return $rows;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"AppreciationManager", true);
            return false;
        }
    }

    protected function add(Modele $modele, Membre $membre, $appreciation) {
        try {
            if($modele instanceof VideoProtubes) $type = 'Video';
            else if($modele instanceof Commentaire) $type = 'Commentaire';
            else return false;
            
            $sql = "INSERT INTO appreciation$type SET
                     id$type = :idT, idUsager = :idU,appreciation = :app";
            /* @var $requete PDOStatement */
            $requete = $this->bd->prepare($sql);
            $requete->bindValue(':idT',$modele->getId());
            $requete->bindValue(':idU',$membre->getId());
            $requete->bindValue(':app',(boolean)$appreciation,PDO::PARAM_BOOL);

            $requete->execute();
            return true;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"AppreciationManager", true);
            return false;
        }
    }

    public function delete($type ,$colonne, $value) {
        try {
            $type = $this->checkType($type);
            if(!$type) return false;
            $requete = $this->bd->prepare("DELETE FROM appreciation$type WHERE ".$colonne." = :colonne");
            $requete->execute(array(':colonne' => $value ));
            return true;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"AppreciationManager", true);
            return false;
        }
    }
    
    public function countAppreciation($type, $idType, $appreciation){
        try{
            $type = $this->checkType($type);
            if(!$type) return false;
            if(is_bool($appreciation)){
                if($appreciation) $appreciation = 1;
                else $appreciation = 0;
            }
            else return false;
            $requete = $this->bd->query("SELECT COUNT(*) AS nb_total FROM appreciation$type WHERE id$type = $idType AND appreciation = $appreciation");
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $rows = (int)$resultat['nb_total'];
            return $rows;
        } catch(Exception $e){
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"AppreciationManager", true);
            return false;
        }
    }
    
    public function checkAppreciationVideo($type ,$idType, $idMembre){
        try{
            $type = $this->checkType($type);
            if(!$type) return false;
            $requete = $this->bd->query("SELECT appreciation FROM appreciation$type WHERE id$type = '$idType' AND idUsager = '$idMembre'");			
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            if($resultat){
                return (boolean)$resultat['appreciation'];
            }
            return null;
        } catch(Exception $e){
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"AppreciationManager", true);
            return null;
        }
    }
    
    protected function checkType($type){
        $type = ucfirst($type);
        if($type !== 'Video' || $type !== 'Commentaire') return false;
        return $type;
    }
    
    public function update(\Observable $subject, $arg = null) {
        if($arg == null) throw new Exception;
        switch ($arg['action']) {
         case 'jaime':
             
         break;
         case 'jaimePas': 
         break;
         case 'annuler': 
         break;
        }
    }
}

?>
