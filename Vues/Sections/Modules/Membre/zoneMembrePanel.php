<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="panelMembreControle">
    <ul id="menuPanelMembre" class="">
        <li><a id="lienGeneralMembre" href="?page=membre">Vue générale</a></li>
        <li><a id="lienProfilMembre" href="?page=membre&action=profile"><?= $langMenu['profil'] ?></a></li>
        <li><a id="lienAlerteMembre" href="?page=membre&action=alerte"><?= $langMenu['alert'] ?></a></li>
        <li><a id="lienGestionnaireMembre" href="?page=membre&action=gestionnaire"><?= $langMenu['gestion'] ?></a></li>
        <li><a id="lienSettingsMembre" href="?page=membre&action=settings"><?= $langMenu['reglage'] ?></a></li>
        <li><a id="lienDeconnexionMembre" href="?page=membre&action=deconnexion"><?= $langMenu['deconnect'] ?></a></li>
    </ul>
</div>
<div id="panelMembreMain">
    <? if(isset($infoBarMembre))require(dirname(__FILE__).'/'.$infoBarMembre); ?>
    <div id="panelMembreContent">
        <? if(isset($panelMembreContent))require(dirname(__FILE__).'/'.$panelMembreContent); ?>
    </div>
</div>
<hr class="clear_both">
<script type="text/javascript" >
    
    var menu = function(){
        return {
            init : function(){
                var ulmenu = document.getElementById('menuPanelMembre');
                var liens = ulmenu.getElementsByTagName('a');
                var url = document.location.href.toLowerCase();
                
                var current = -1;
                var l = -1;
                var hasEnd = false;
                
                for (var i = 0; i < liens.length; i++){
                    if(liens[i].href && url.indexOf(liens[i].href.toLowerCase()) !== -1 && liens[i].href.length > l){
                        current = i;
                        l = liens[i].href.length;
                    }
                    if(liens[i].className === "end"){
                        hasEnd = true;
                    }
                }
                
                if (current > -1) {
                    liens[current].className = 'lienCourant';
                }
                l = liens.length;
                if (hasEnd) l--;
                
                for (i = 0; i < l; i++) {
                    liens[i].onmouseover = function () {
                        for (j = 0; j < l; j++) {
                            liens[j].className = '';
                        }
                        this.className = 'lienCourant';
                    };
                    liens[i].onmouseout = function () {
                        for (j = 0; j < l; j++) {
                            liens[j].className = '';
                            if (current > -1) {
                                liens[current].className = 'lienCourant';
                            }
                        }
                    };
                }
                
            }
        };
    }();
    
    addEvent(window,'load',menu.init);
    
</script>