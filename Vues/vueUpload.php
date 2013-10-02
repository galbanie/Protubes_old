<?php
require(dirname(__FILE__).'/../Languages/lang_'.$_SESSION['lang'].'_inc.php'); 
?>

<?php $titrePage = $langTitre['upload']; ?>

<?php ob_start(); ?>
    <? require(dirname(__FILE__).'/'.$includeBtnUser); ?>
<?php $btnMembre = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="centreUnique">
        <? require(dirname(__FILE__).'/'.$includeFormulaireUpload); ?>
        <div id="upload-section-msg">
        <?php
            foreach ($messages as $key => $message) {
                require(dirname(__FILE__)."/Sections/Messages/msg".$message."VideoUpload.php");
            }
        ?>
        </div>
    </div>   
<?php $centre = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>