<?php
require dirname(__FILE__).'/Librairie/Autoloader.php';
    
new Autoloader();

if ( isset($_GET['id']) ){
    $id = intval ($_GET['id']);
    
    $file = new FileManager(DataBase::instancie());
    
    $resultat = $file->selectBlob($id);
    
    if ($resultat){
        header ("Content-type: ".$resultat["mime"]);
        echo $resultat["data"];
    } 
}

?>
