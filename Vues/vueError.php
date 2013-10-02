<?php
//require(dirname(__FILE__).'/../Languages/lang_'.$_SESSION['lang'].'_inc.php'); 
?>

<?php //$titrePage = $langTitre['erreur']; ?>

<?php ob_start(); ?>
    <? //require(dirname(__FILE__).'/'.$includeBtnUser); ?>
<?php $btnMembre = ob_get_clean(); ?>

<?php ob_start(); ?>
<div id="centreUnique">
    <p>Une erreur est survenue : <?= $msgErreur ?></p>
</div>
<?php $centre = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>