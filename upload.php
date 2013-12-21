<?php
require dirname(__FILE__).'/Librairie/Autoloader.php';
    
new Autoloader();

//session_start();

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}

$fileName = $_FILES['fichier']['name'];
$fileType = $_FILES['fichier']['type'];
$fileSize = bytesToSize1024($_FILES['fichier']['size'], 1);
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
            //$_SESSION['modif'] = true;
            //ControleUpdate::add($membreTemp, 'membre');
            $resultat = $file->selectBlob($idImage);
            echo Base64EncodeImage::base64_encode_image_binary($resultat["data"], $resultat["mime"]);
        }
    }
    else{

    }
}


/*echo <<<EOF
<p>Your file: {$sFileName} has been successfully received.</p>
<p>Type: {$sFileType}</p>
<p>Size: {$sFileSize}</p>
EOF;*/



?>
