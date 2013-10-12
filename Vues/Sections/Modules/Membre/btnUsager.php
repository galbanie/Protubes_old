<?php

//print_r($_SESSION['usager']);
//var_dump($_SESSION['usager']);
?>

<div id="espaceBtnMembre">
    <ul id="ul1" class="ul-niveau1">
        <li class="li-1" >
            <a class="lien-img-membre" href="?page=membre">
                <img class="img-user" src="<? if($_SESSION['membre']->getIdImage() !== null) echo 'getImage.php?id='.$_SESSION['membre']->getIdImage();else echo 'Ressources/Images/Profil_default.jpg'?>" />
                <span class="name-user"><?= $_SESSION['membre']->getIdentifiant(); ?></span>
            </a>
        </li>
        <li id="menuDeroulant" class="li-2" onclick="displayElement('ul2');">
            <ul id="ul2" class="ul-niveau2" style="display: none;">
                <li><a id="aProfil" href="?page=membre&action=profile"><?= $langMenu['profil'] ?></a></li>
                <li><a id="aAlerte" href="?page=membre&action=alerte"><?= $langMenu['alert'] ?></a></li>
                <li><a id="aGestionnaire" href="?page=membre&action=gestionnaire"><?= $langMenu['gestion'] ?></a></li>
                <li><a id="aSettings" href="?page=membre&action=settings"><?= $langMenu['reglage'] ?></a></li>
                <li><a id="aDeconnexion" href="?page=membre&action=deconnexion"><?= $langMenu['deconnect'] ?></a></li>
            </ul>
        </li>
    </ul>
</div>

<script type="text/javascript">
    var ul1 = document.getElementById('ul1');
    var ul2 = document.getElementById('ul2');
    var declencheur = document.getElementById('menuDeroulant');
    largeur = ul1.offsetWidth;
    
    function addEvent(element, event, func) {
 
        if (element.addEventListener) { // Si notre élément possède la méthode addEventListener()
            element.addEventListener(event, func, false);
        } else { // Si notre élément ne possède pas la méthode addEventListener()
            element.attachEvent('on' + event, func);
        } 
    }
    
    function displayElement(element){
        var test = document.getElementById(element).style.display;
        if (test === "block") 
        {
            document.getElementById(element).style.display = "none";
        }
        else 
        {
            document.getElementById(element).style.display = "block";
        }
    }
    
    addEvent(declencheur,'click',function(){
     ul2.style.width = (largeur+2)+'px';
     //alert(largeur);
    });
</script>