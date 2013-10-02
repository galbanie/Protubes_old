<?php

/**
 * Description of Video
 *
 * @author galbanie
 */
class VideoProtubes extends Modele implements Appreciable {
    private $datePublication;
    private $idImage;
    private $chemin;
    private $titre;
    private $description;
    private $categorie;
    private $idUser;
    
    function __construct($id = null, $datePublication = "", $idImage = null, $chemin = "", $titre = "", $description = "", $categorie = "", $idUser = null) {
        $this->setId($id);
        $this->setDatePublication($datePublication);
        $this->setIdImage($idImage);
        $this->setChemin($chemin);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setCategorie($categorie);
        $this->setIdUser($idUser);
    }
    
    public function getDatePublication() {
        return $this->datePublication;
    }

    public function setDatePublication($datePublication,$notify = false) {
        $this->datePublication = $datePublication;
        if($notify) $this->notifyObservers ();
    }

    public function getIdImage() {
        return $this->image;
    }

    public function setIdImage($idImage,$notify = false) {
        $this->image = $idImage;
        if($notify) $this->notifyObservers ();
    }

    public function getChemin() {
        return $this->chemin;
    }

    public function setChemin($chemin,$notify = false) {
        $this->chemin = $chemin;
        if($notify) $this->notifyObservers ();
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre,$notify = false) {
        $this->titre = $titre;
        if($notify) $this->notifyObservers ();
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description,$notify = false) {
        $this->description = $description;
        if($notify) $this->notifyObservers ();
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie,$notify = false) {
        $this->categorie = $categorie;
        if($notify) $this->notifyObservers ();
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser,$notify = false) {
        $this->idUser = $idUser;
        if($notify) $this->notifyObservers ();
    }

    public function annuler($idUsager) {
        
    }

    public function jaime($idUsager) {
        
    }

    public function jaimePas($idUsager) {
        
    }
    
}

?>
