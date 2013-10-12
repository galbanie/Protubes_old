<?php

if ( isset($_GET['id']) ){
    $id = intval ($_GET['id']);
    
    $config = Config::getConfig("bd_local_native");
    
    $connexion = mysql_pconnect($config['host'], $config['username'], $config['password'])
            or die("Impossible de se connecter à la base de données");
    
    mysql_select_db($config['database'], $connexion)
        or die("Base de données introuvable");
    
    $requete = "SELECT * FROM image WHERE id = ".$id;
    $resultat = mysql_query ($requete) or die (mysql_error ());
    $resultat = mysql_fetch_row ($resultat);
    
    if ($resultat){
        header ("Content-type: ".$resultat[3]);
        echo $resultat[5];
    }
}

?>
