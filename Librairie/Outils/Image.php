<?php

/**
 * Description of Image
 *
 * @author galbanie
 */
class Image{
    
    public static $typesImage = array(
        'image/gif',    'image/jpeg',   'image/png',
        'image/psd',    'image/bmp',    'image/tiff'
    );
    
    public static function isImageType($type){
        return in_array($type, self::$typesImage);
    }
    
    public static function redimensionnerImage($source, $new_value, $type_value = "W"){
        /*
            Récupération des dimensions de l'image afin de vérifier
            que ce fichier correspond bel et bien à un fichier image.
            Stockage dans deux variables le cas échéant.
          */
          if( !( list($source_largeur, $source_hauteur) = @getimagesize($source) ) ) {
            return false;
          }
          /*
            Calcul de la valeur dynamique en fonction des dimensions actuelles
            de l'image et de la dimension fixe que nous avons précisée en argument.
          */
          if( $type_value == "H" ) {
            $nouv_hauteur = $new_value;
            $nouv_largeur = ($new_value / $source_hauteur) * $source_largeur;
          } else {
            $nouv_largeur = $new_value;
            $nouv_hauteur = ($new_value / $source_largeur) * $source_hauteur;
          }
          /*
         Création du conteneur, c'est-à-dire l'image qui va contenir la version
          redimensionnée. Elle aura donc les nouvelles dimensions.
          */
          $image = imagecreatetruecolor($nouv_largeur, $nouv_hauteur);
          /*
            Importation de l'image source. Stockage dans une variable pour pouvoir
            effectuer certaines actions.
          */
          $source_image = imagecreatefromstring(file_get_contents($source));
          /*
            Copie de l'image dans le nouveau conteneur en la rééchantillonant. Ceci
            permet de ne pas perdre de qualité.
          */
          imagecopyresampled($image, $source_image, 0, 0, 0, 0, $nouv_largeur, $nouv_hauteur, $source_largeur, $source_hauteur);
          /*
            Si nous avons spécifié une sortie et qu'il s'agit d'un chemin valide (accessible
            par le script)
          */
          
          return $image;
    }
    
}

?>
