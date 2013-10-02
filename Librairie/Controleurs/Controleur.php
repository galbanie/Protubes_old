<?php

/**
 * Description of Controleur
 *
 * @author galbanie
 */
abstract class Controleur {
    
    protected $donnees;
  // affiche la page cliquer 
    protected function genererVue($vue){
        $fichierVue = 'Vues/'.$vue.'.php';
        if (file_exists($fichierVue)){
            extract(Donnees::getDonnees());
            require $fichierVue;
        }
        else {
            throw new Exception("Fichier $fichierVue non trouvé");
        }
    }
}

?>
