<?php
require(dirname(__FILE__).'/../Languages/lang_'.$_SESSION['lang'].'_inc.php'); 
?>

<?php $titrePage = $langTitre['search']; ?>

<?php ob_start(); ?>
     <?php require(dirname(__FILE__).'/'.$includeBtnUser); ?>
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
        <?php require(dirname(__FILE__).'/Sections/Modules/pub.php'); ?>
    </div>
<?php $droite = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>