<?php

/**
 * Description of UsagerManager
 *
 * @author galbanie
 */
class MembreManager extends DAO {
    
    function __construct(PDO $bd) {
        $this->setBd($bd);
    }

    /* @var $objet Membre*/
    public function add($objet) {
        try {
             $sql = "INSERT INTO membre SET
                     nom = :nom, prenom = :prenom,idImage = :im, identifiant = :identifiant,
                     email = :email, password = :password, dateNaissance = :dn,
                     dateInscription = :di, pays = :pays, codePostal = :cp,
                     telephone = :tel";
            /* @var $requete PDOStatement */
            $requete = $this->bd->prepare($sql);
            $requete->bindValue(':nom',$objet->getNom());
            $requete->bindValue(':prenom',$objet->getPrenom());
            $requete->bindValue(':im',$objet->getIdImage());
            $requete->bindValue(':identifiant',$objet->getIdentifiant());
            $requete->bindValue(':email',$objet->getEmail());
            $requete->bindValue(':password',$objet->getPassword());
            $requete->bindValue(':dn',$objet->getDateNaissance());
            $requete->bindValue(':di',$objet->getDateInscription());
            $requete->bindValue(':pays',$objet->getPays());
            $requete->bindValue(':cp',$objet->getCodePostal());
            $requete->bindValue(':tel',$objet->getTelephone());

            $requete->execute();
            return $this->bd->lastInsertId();
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function countRows() {
        try {
            $requete = $this->bd->query("SELECT COUNT(*) AS nb_total FROM membre");
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $rows = (int)$resultat['nb_total'];
            return $rows;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function delete($colonne, $value) {
        try {
            $requete = $this->bd->prepare("DELETE FROM membre WHERE ".$colonne." = :colonne");
            $requete->execute(array(':colonne' => $value ));
            return true;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function get($colonne, $value) {
        try {
            $requete = $this->bd->prepare("SELECT * FROM membre WHERE ".$colonne." = :colonne");
            $requete->execute(array(':colonne' => $value));			
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            if($resultat){
                $membre = new Membre();
                $membre->setTableauDonnees($resultat);			
                $requete->closeCursor();
                return $membre;
            }			
            //$requete>closeCursor();
            return null;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function getList($colonne, $value) {
        try {
            $liste = new Liste();
            $requete = $this->bd->prepare("SELECT * FROM membre WHERE ".$colonne." = :colonne");
            $requete->execute( array( ':colonne' => $value ) );			
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $membre = new Membre();
                $membre->setTableauDonnees($donnee);
                $liste->add($membre);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function getListAll() {
        try {
            $liste = new Liste();
            $requete = $this->bd->query("SELECT * FROM membre");
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $membre = new Membre();
                $membre->setTableauDonnees($donnee);
                $liste->add($membre);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function getListAllLimit($limitStart, $pagination) {
        try {
            $liste = new Liste();
            $requete = $this->bd->query("SELECT * FROM membre LIMIT ".$limitStart.",".$pagination);
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $membre = new Membre();
                $membre->setTableauDonnees($donnee);
                $liste->add($membre);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function getListLimit($colonne, $value, $limitStart, $pagination) {
        try {
            $liste = new Liste();
            $requete = $this->bd->query("SELECT * FROM membre WHERE $colonne = $value LIMIT ".$limitStart.",".$pagination);
            while ($donnee = $requete->fetch(PDO::FETCH_ASSOC)){
                $membre = new Membre();
                $membre->setTableauDonnees($donnee);
                $liste->add($membre);
            }
            return $liste;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }

    public function update(Observable $subject, $arg = null) {
        try {
            $sql = "UPDATE membre SET 
                     nom = :nom, prenom = :prenom,idImage = :im, identifiant = :identifiant,
                     email = :email, password = :password, dateNaissance = :dn,
                     dateInscription = :di, pays = :pays, codePostal = :cp,
                     telephone = :tel WHERE id = :id";
            /* @var $requete PDOStatement */
            $requete = $this->bd->prepare($sql);
            $requete->bindValue(':id',$subject->getId());
            $requete->bindValue(':nom',$subject->getNom());
            $requete->bindValue(':prenom',$subject->getPrenom());
            $requete->bindValue(':im',$subject->getIdImage());
            $requete->bindValue(':identifiant',$subject->getIdentifiant());
            $requete->bindValue(':email',$subject->getEmail());
            $requete->bindValue(':password',$subject->getPassword());
            $requete->bindValue(':dn',$subject->getDateNaissance());
            $requete->bindValue(':di',$subject->getDateInscription());
            $requete->bindValue(':pays',$subject->getPays());
            $requete->bindValue(':cp',$subject->getCodePostal());
            $requete->bindValue(':tel',$subject->getTelephone());

            $requete->execute();
            return true;
        } catch (Exception $e) {
            TraceErreur::ecrireLog('./log.txt',$e->getTraceAsString(),"MembreManager", true);
            return false;
        }
    }
}

?>
