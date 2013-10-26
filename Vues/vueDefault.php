<?php
require(dirname(__FILE__).'/../Languages/lang_'.$_SESSION['lang'].'_inc.php'); 
?>

<?php $titrePage = $langTitre['default']; ?>

<?php ob_start(); ?>
    <?php require dirname(__FILE__).'/'.$includeBtnUser; ?>
<?php $btnMembre = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="sidebarGauche">
        <?php require(dirname(__FILE__).'/'.$includeSidebarGauche); ?>
    </div>
<?php $gauche = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="centre">
        <!--p>centre</p>
        <p><?php //print_r($_POST) ?></p-->
        <div id="centreBlockVideopromo">
            <h2>Titre de la video</h2>
            <div id="videopromo">
                <h2 style="text-align: center;">Video Promo</h1>
            </div>
            <div id="videopromoinfo">
                <p>Information sur la video</p>
            </div>
        </div>
        <div id="centreVideosSlide">
            <h2>Videos dans un slider</h2>
        </div>
        <div id="centreVideosPopulaires">
            <h2>Videos les plus populaires</h2>
            <div class="videoAffichageBlock divGauche">
                <h3>Video en question 1</h3>
            </div>
            <div class="videoAffichageBlock">
                <h3>Video en question 2</h3>
            </div>
            <div class="videoAffichageBlock divGauche">
                <h3>Video en question 3</h3>
            </div>
            <div class="videoAffichageBlock">
                <h3>Video en question 4</h3>
            </div>
            <div class="videoAffichageBlock divGauche">
                <h3>Video en question 5</h3>
            </div>
            <div class="videoAffichageBlock">
                <h3>Video en question 6</h3>
            </div>
        </div>
    </div>
<?php $centre = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="sidebarDroit">
        <?php require(dirname(__FILE__).'/Sections/Modules/pub.php'); ?>
    </div>
<?php $droite = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>