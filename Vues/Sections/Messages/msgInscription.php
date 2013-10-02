<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div>
    <h2><?= $langMsg['msg02h2'];?></h2>
    <p><?= $langMsg['msg02p1'];?></p>
    <form id="form-msg-inscription" method="POST" action="">
        <div id="membre-section-msg-btnSbmit">
            <input type="hidden" name="formulaire" value="Inscription" />
            <input type="submit" value="<?= $langBtn['btn1Msg02'];?>" />
        </div>
    </form>
    
</div>