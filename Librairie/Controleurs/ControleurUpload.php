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
                
                if(isset($_REQUEST['form']) && $_REQUEST['form'] === 'addImage'){
                    $fileName = $_FILES['fichier']['name'];
                    $fileType = $_FILES['fichier']['type'];
                    //$fileSize = bytesToSize1024($_FILES['fichier']['size'], 1);
                    //echo $fileName;
                    //var_dump($_FILES);
                    //var_dump($_REQUEST);

                    if(is_uploaded_file($_FILES['fichier']['tmp_name'])){
                        if(Image::isImageType($fileType)){

                            $file = new FileManager(DataBase::instancie());

                            $idImage = $file->insertBlob($_FILES['fichier']['tmp_name'], $fileType);

                            //echo $idImage;

                            if($idImage && $idImage !== 0){
                                $date = new DateTime('NOW');
                                $membreManager = new MembreManager(DataBase::instancie());
                                $membreTemp = $membreManager->get('id',$_REQUEST['idMembre']);
                                $membreTemp->setImage($idImage);
                                $membreManager->addFileMembre($membreTemp->getId(), $idImage, $date->format('d/m/Y H:i:s'));
                                $membreManager->update($membreTemp);
                                $membreTemp = $membreManager->get('id',$_REQUEST['idMembre']);
                                $_SESSION['membre'] = $membreTemp;
                                //ControleUpdate::add($membreTemp, 'membre');
                                $resultat = $file->selectBlob($idImage);
                                echo Base64EncodeImage::base64_encode_image_binary($resultat["data"], $resultat["mime"]);
                            }
                        }
                    }
                    return;
                }
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
    
    function bytesToSize1024($bytes, $precision = 2) {
        $unit = array('B','KB','MB');
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
    }
}

?>
