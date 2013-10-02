<?php

/**
 * Description of ControleurUpload
 *
 * @author galbanie
 */
class ControleurUpload extends Controleur{
    
    public function __construct() {
        
    }
    
    public function executerAction(){
        try{
            if(isset($_SESSION['membre']) && isset($_SESSION['compte']) && $_SESSION['compte']->isActif()){
                $this->affecterMessage();
                Donnees::ajouterValeur('Sections/Formulaires/formUploadVideo.php', 'includeFormulaireUpload');
            }
            else {
                header("Location: ?page=membre&m=upload");
                exit();
            }
            $this->genererVue('vueUpload');
        } catch(Exception $e){
            $this->genererVue('vueError');
        }
    }
    
    protected function affecterMessage(){
        Donnees::ajouterValeur(array("Taille", "Type"), 'messages');
    }
}

?>
