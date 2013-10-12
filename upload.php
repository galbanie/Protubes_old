<?php
require dirname(__FILE__).'/Librairie/Autoloader.php';
    
new Autoloader();

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}

$fileName = $_FILES['fichier']['name'];
$fileType = $_FILES['fichier']['type'];
$fileSize = bytesToSize1024($_FILES['fichier']['size'], 1);

var_dump($_FILES);
//var_dump($_REQUEST);

if(is_uploaded_file($_FILES['fichier']['tmp_name'])){
    if(Image::isImageType($fileType)){
        $image = new Image(null,$fileName,$fileSize,$fileType,"",file_get_contents($_FILES['fichier']['tmp_name']));
        var_dump($image);
        $imageManager = new ImageManager(DataBase::instancie());
        
        $idImage = $imageManager->add($image);
        if($idImage && $idImage !== 0){
            $image->setId($idImage);
            $date = new DateTime('NOW');
            $imageManager->addImageMembre($_REQUEST['idMembre'], $image->getId(), $date->format('d/m/Y H:i:s'));

            $membreManager = new MembreManager(DataBase::instancie());
            $membreTemp = $membreManager->get('id',$_REQUEST['idMembre']);;
            $membreTemp->setIdImage($image->getId());
            $membreManager->update($membreTemp);
            
            var_dump($image);

            echo $image->getId();
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
