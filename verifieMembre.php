<?php

require dirname(__FILE__).'/Librairie/Autoloader.php';
    
new Autoloader();

header('Content-type: text/plain');
$membreManager = new MembreManager(DataBase::instancie());



if(isset($_REQUEST['method'])){
    if($_REQUEST['method'] == 'inscription'){
        if(isset($_REQUEST['identifiant']) || isset($_REQUEST['email'])){
            if(isset($_REQUEST['identifiant'])){
                $usager = $membreManager->get('identifiant', $_REQUEST['identifiant']);
                if($usager){
                    echo 'member';
                }
                else echo 'no member';
            }
            if(isset($_REQUEST['email'])){
                $usager = $membreManager->get('email', $_REQUEST['email']);
                if($usager){
                    echo 'member';
                }
                else echo 'no member';
            }
        }
        else{
            echo 'no param';
        }
    }
    else if($_REQUEST['method'] == 'connexion'){
        if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
            $usager = $membreManager->get('email', $_REQUEST['email']);
            if($usager){
                if($usager->getPassword() == Crypteur::getCrypteur()->code($_REQUEST['password'])){
                    echo 'ok';
                }
                else echo 'pwd error';
            }
            else echo 'email error';
        }
        else echo 'no param';
    }
    else echo 'error method';
}
else{
    echo 'no method';
}


?>
