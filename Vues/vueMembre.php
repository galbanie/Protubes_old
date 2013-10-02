<?php
require(dirname(__FILE__).'/../Languages/lang_'.$_SESSION['lang'].'_inc.php'); 
?>

<?php $titrePage = $langTitre['membre'].(isset($_SESSION['membre'])?"":$langForm[$formulaire]); ?>

<?php ob_start();?>
    <? require(dirname(__FILE__).'/'.$includeBtnUser); ?>
<?php $btnMembre = ob_get_clean(); ?>

<?php ob_start();?>
    <div id="centreUnique">
        <div id="membre-main">
            <? require(dirname(__FILE__).'/'.$includeSectionMembre); ?>
            <hr class="clearfloatBoth" />
        </div>
    </div>
<?php $centre = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
