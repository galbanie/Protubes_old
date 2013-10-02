<?php

/**
 * Description of TraceErreur
 *
 * @author galbanie
 */
class TraceErreur {
    private static $instance = null;
    private static $cheminLog = "";
    private static $fichierLog = null;
    public static $msgEchecEcriture = "";
    
    protected function __construct() {
        
    }
    
    public static function getCheminLog() {
        return self::cheminLog;
    }
    
    public static function ecrireLog($cheminLog, $string, $class = "", $date = true){
        if(self::$instance == null){
            self::$instance = new self;
        }
        self::$cheminLog = $cheminLog;
        if(empty(self::$cheminLog)){
            self::$msgEchecEcriture = "Aucun chemin renseigné.";
            return false;
        }
        if(!self::$fichierLog = @fopen(self::cheminLog, "at")){
            self::$msgEchecEcriture = "Erreur fopen.";
            return false;
        }
        if(is_writable(self::cheminLog)){
            if(!self::fichierLog){
                self::$msgEchecEcriture = "Impossible d'ouvrir le fichier ".basename(self::cheminLog);
                return false;
            }
            else{
                $log = "";
                if($date) $log = "[".date('c')."] ".$class." --> (".$string.")\n";
                if(fwrite(self::fichierLog, $log) === false){
                    self::$msgEchecEcriture = "Impossible d'écrire dans le fichier".basename(self::cheminLog);
                    return false;
                }
                else{
                    self::$msgEchecEcriture = "";
                    return true;
                }
            }
        }
        else{
            self::$msgEchecEcriture = "Le fichier ".basename(self::cheminLog)." n'est pas accéssible.";
            return false;
        }
    }

}

?>
