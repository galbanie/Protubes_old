<?php
//require(dirname(__FILE__).'/../Languages/lang_'.$_SESSION['lang'].'_inc.php'); 
?>

<?php //$titrePage = $langTitre['vue']; ?>

<?php ob_start(); ?>
    <? //require(dirname(__FILE__).'/'.$includeBtnUser); ?>
<?php $btnMembre = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="sidebarGauche">
                
    </div>
<?php $gauche = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="centre">
                
    </div>
<?php $centre = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="sidebarDroit">
                 
    </div>
<?php $droite = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>