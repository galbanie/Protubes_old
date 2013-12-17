<?php

/**
 * Description of ImageManager
 *
 * @author galbanie
 */
class ImageManager extends DAO {
    
    function __construct(PDO $bd) {
        $this->setBd($bd);
    }

    /* @var $objet Image*/
    public function add($objet) {
        try {
             /*$sql = "INSERT INTO image SET
                     nom = :nom, taille = :taille,type = :type,
                     desc = :desc, blob = :blob";*/
             $sql = "INSERT INTO image
                     (nom,taille,type,desc,blob) VALUES (?,?,?,?,?)";
            /* @var $requete PDOStatement */
            /*$requete = $this->bd->prepare($sql);
            $requete->bindValue(':nom',$objet->getNom());
            $requete->bindValue(':taille',$objet->getTaille());
            $requete->bindValue(':type',$objet->getType());
            $requete->bindValue(':desc',$objet->getDesc());
            $requete->bindValue(':blob',addslashes($objet->getBlob()),PDO::PARAM_LOB);*/
            
            $requete = $this->bd->prepare($sql);
            $requete->bindValue(1,$objet->getNom());
            $requete->bindValue(2,$objet->getTaille());
            $requete->bindValue(3,$objet->getType());
            $requete->bindValue(4,$objet->getDesc());
            $requete->bindValue(5,$objet->getBlob(),PDO::PARAM_LOB);

            $requete->execute();
            return $this->bd->lastInsertId();
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function countRows() {
        try {
            $requete = $this->bd->query("SELECT COUNT(*) AS nb_total FROM image");
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $rows = (int)$resultat['nb_total'];
            return $rows;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function delete($colonne, $value) {
        try {
            $requete = $this->bd->prepare("DELETE FROM image WHERE ".$colonne." = :colonne");
            $requete->execute(array(':colonne' => $value ));
            return true;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function get($colonne, $value) {
        try {
            $requete = $this->bd->prepare("SELECT * FROM image WHERE ".$colonne." = :colonne");
            $requete->execute(array(':colonne' => $value));			
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            if($resultat){
                $image = new Image();
                $image->setTableauDonnees($resultat);			
                $requete->closeCursor();
                return $image;
            }			
            //$requete>closeCursor();
            return null;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function getList($colonne, $value) {
        try {
            $liste = new Liste();
            $requete = $this->bd->prepare("SELECT * FROM image WHERE ".$colonne." = :colonne");
            $requete->execute( array( ':colonne' => $value ) );			
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $image = new Image();
                $image->setTableauDonnees($donnee);
                $liste->add($image);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function getListAll() {
        try {
            $liste = new Liste();
            $requete = $this->bd->query("SELECT * FROM image");
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $image = new Image();
                $image->setTableauDonnees($donnee);
                $liste->add($image);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function getListAllLimit($limitStart, $pagination) {
        try {
            $liste = new Liste();
            $requete = $this->bd->query("SELECT * FROM image LIMIT ".$limitStart.",".$pagination);
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $image = new Image();
                $image->setTableauDonnees($donnee);
                $liste->add($image);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function getListLimit($colonne, $value, $limitStart, $pagination) {
        try {
            $liste = new Liste();
            $requete = $this->bd->query("SELECT * FROM image WHERE $colonne = $value LIMIT ".$limitStart.",".$pagination);
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $image = new Image();
                $image->setTableauDonnees($donnee);
                $liste->add($image);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }

    public function update(Observable $subject, $arg = null) {
        try {
            $sql = "UPDATE image SET 
                     nom = :nom, taille = :taille,type = :type,
                     desc = :desc, blob = :blob WHERE id = :id";
            /* @var $requete PDOStatement */
            $requete = $this->bd->prepare($sql);
            $requete->bindValue(':id',$subject->getId());
            $requete->bindValue(':nom',$subject->getNom());
            $requete->bindValue(':taille',$subject->getTaille());
            $requete->bindValue(':type',$subject->getType());
            $requete->bindValue(':desc',$subject->getDesc());
            $requete->bindValue(':blob',  addslashes($subject->getBlob()),PDO::PARAM_LOB);

            $requete->execute();
            return true;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }
    
    public function addImageMembre($idMembre,$idImage,$date){
        try{
            $sql = "INSERT INTO ajouteimage SET
                     idMembre = :idM, idImage = :idI,date = :date";
            /* @var $requete PDOStatement */
            $requete = $this->bd->prepare($sql);
            $requete->bindValue(':idM',$idMembre);
            $requete->bindValue(':idI',$idImage);
            $requete->bindValue(':date',$date);
            
            $requete->execute();
            return true;
        }
        catch (Exception $e){
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"ImageManager", true);
            return false;
        }
    }
    
}

?>
