<?php

/**
 * Description of Image
 *
 * @author galbanie
 */
class Image extends Modele{
    
    public static $typesImage = array(
        'image/gif',    'image/jpeg',   'image/png',
        'image/psd',    'image/bmp',    'image/tiff'
    );

    private $nom;
    private $taille;
    private $type;
    private $desc;
    private $blob;
    
    function __construct($id = null, $nom = "", $taille = "", $type = "", $desc = "", $blob = null) {
        $this->setId($id);
        $this->setNom($nom);
        $this->setTaille($taille);
        $this->setType($type);
        $this->setDesc($desc);
        $this->setBlob($blob);
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom,$notify = false) {
        $this->nom = $nom;
        if($notify) $this->notifyObservers ();
    }

    public function getTaille() {
        return $this->taille;
    }

    public function setTaille($taille,$notify = false) {
        $this->taille = $taille;
        if($notify) $this->notifyObservers ();
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type,$notify = false) {
        $this->type = $type;
        if($notify) $this->notifyObservers ();
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc,$notify = false) {
        $this->desc = $desc;
        if($notify) $this->notifyObservers ();
    }

    public function getBlob() {
        return $this->blob;
    }

    public function setBlob($blob,$notify = false) {
        $this->blob = addslashes($blob);
        if($notify) $this->notifyObservers ();
    }

    public function echoImage(){
        if($this->blob !== null){
            header("Content-type :$this->type");
            echo $this->blob;
        }
    }
    
    public static function isImageType($type){
        return in_array($type, self::$typesImage);
    }
    
}

?>
