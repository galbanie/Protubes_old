<div id="membre-section-msg">
    <?php
        /*var_dump($formulaire);
        var_dump($_POST);*/
        foreach ($messages as $key => $message) {
            require(dirname(__FILE__)."/../../Messages/msg".$message.".php");
        }
    ?>
</div>
<div id="membre-section-form">
    <?php
    //var_dump($etatInscription);
    if(isset($etat)) require(dirname(__FILE__)."/../Etat.php");
    else require(dirname(__FILE__)."/../../Formulaires/form".$formulaire.".php");
    ?>
</div>