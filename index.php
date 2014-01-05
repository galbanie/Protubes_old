<?php
    require dirname(__FILE__).'/Librairie/Autoloader.php';
    
    new Autoloader();
    /* From : Marc
     * Message : Il est important de garder cette include 
     *          sous l'instanciation de Autoloader car
     *          le fichier Session.php utilise la classe
     *          Config.
     */
    // Include qui permet de modifier la manière de stocker la session.
    require_once 'Session.php';
    
    session_start();
    /*
     * Voir la fonction alternerFormulaire() dans le contrôleur Membre
     */
    //$_SESSION['form'] = "Connexion"; 
    $controleur = new ControleurFrontal();
    $controleur->routerRequete();
?>