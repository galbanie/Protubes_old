<?php
define("duree_session", get_cfg_var("session.gc_maxlifetime"));
include_once './Librairie/Configuration/Config.php';
$config = Config::getConfig("bd_local_native");

$connexion = "";

function ouvrir($cheminSession, $nomSession){
    global $connexion;
    global $config;
    
    $connexion = mysql_pconnect($config['host'], $config['username'], $config['password'])
            or die("Impossible de se connecter à la base de données");
    
    mysql_select_db($config['database'], $connexion)
        or die("Base de données introuvable");
    
    return true;
}

function fermer(){
    return true;
}

function ecrire($idSession, $valeur){
    global $connexion;
    
    if(mysql_query("INSERT INTO sessions VALUES('$idSession',".(time()+duree_session).",'$valeur')",$connexion))
            return true;
    else
        return mysql_query ("UPDATE sessions SET expiration = ".(time()+duree_session).",valeur = '$valeur'
                            WHERE idsession = '$idSession'", $connexion);
}

function lire($idSession){
    global $connexion;
    
    $requete = mysql_query("SELECT valeur FROM sessions WHERE idsession = '$idSession' AND expiration > ".time(), $connexion);
    
    if(list($valeur) = mysql_fetch_row($requete))
            return $valeur;
    else
        return false;
}

function detruire($idSession){
    global $connexion;
    
    return mysql_query("DELETE FROM sessions WHERE idsession = '$idSession'",$connexion);
}

function nettoyer($dureeVie){
    global $connexion;
    
    return mysql_query("DELETE FROM sessions WHERE expiration < ".time(),$connexion);
}

session_set_save_handler("ouvrir", "fermer", "lire", "ecrire", "detruire", "nettoyer");

?>
