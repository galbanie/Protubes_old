<h1 class="titreSectionMembre">Modification du profile</h1>
<div id="fenetre-images-membre" style="display: none;">
    <a id="close-win-img-member" href="#" class="icone-close close"></a>
</div>

<form name="form" method="POST" enctype="multipart/form-data" action="?page=upload" style="display: none;">
    <input type="hidden" name="form" value="addImage" />
    <input type="hidden" name="idMembre" value="<?= $_SESSION['membre']->getId();?>" />
    <input name="fichier" type="file" onchange="if(fichierSelected(this))demarrageChargement(document.form);" />
</form>

<form id="formProfileMembre" method="POST" action="">
    <div id="imageMembreProfile">
        <img id="imageProfil" name="imageProfil" src="<?php if($_SESSION['membre']->getImage() !== null) echo 'getImage.php?id='.$_SESSION['membre']->getImage();else echo 'Ressources/Images/Profil_default.jpg'?>" />
        <a id="lienSurImage" href="#" onclick="showHideElementBlock('divCHoixActionChangeImage');">Changer l'image</a>
        <div id="divCHoixActionChangeImage" style="display: none;">
            <a href="#" onclick="showHideElementBlock('divCHoixActionChangeImage');declencheChargement(document.forms['form']);">Charger depuis votre ordinateur</a>
            <a id="show-win-img-member" href="#" onclick="showHideElementBlock('divCHoixActionChangeImage');">Choisir parmis vos images</a>
        </div>
    </div>
    <div id="information1">
        <div>
            <label class="labelInfo"><?= $langForm['nom'];?></label>
            <input id="nom" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getNom();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div> 
        <div>
            <label class="labelInfo"><?= $langForm['prenom'];?></label>
            <input id="prenom" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getPrenom();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
        <div>
            <label class="labelInfo">Identifiant</label>
            <input id="identifiant" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getIdentifiant();?>" readonly />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
        <div>
            <label class="labelInfo">Email</label>
            <input id="email" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getEmail();?>" readonly />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
    </div>
    <div id="information2">
        <div>
            <label class="labelInfo">Mot de passe</label>
            <input id="password" class="inputInfo"type="password" value="<?=$_SESSION['membre']->getPassword();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
        <div>
            <label class="labelInfo">Date de naissance</label>
            <input id="dateNaissance" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getDateNaissance();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
        <div>
            <label class="labelInfo">Téléphone</label>
            <input id="telephone" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getTelephone();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
        <div>
            <label class="labelInfo">Code Postale</label>
            <input id="postale" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getCodePostal();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
        <div>
            <label class="labelInfo">Pays</label>
            <input id="pays" class="inputInfo" type="text" value="<?=$_SESSION['membre']->getPays();?>" />
            <!--input class="buttonEdit" type="button" value="Modifier" /-->
        </div>
    </div>
    <div id="stateMembreProfile">
        <div class="boxInfoDiv" >
            <span class="spanHaut">Inscris depuis</span>
            <span class="spanBas" ><?=$_SESSION['membre']->getDateInscription();?></span>   
        </div>
        <div class="boxInfoDiv" >
            <span class="spanHaut">Status</span>
            <span class="spanBas" >actif</span>   
        </div>
    </div>
    <hr class="clearfloatBoth" />
    <div id="confirEditMembreProfile">
        <input type="reset" value="Annuler" />
        <input type="submit" value="Enregistrer les modifications" />
    </div>
</form>
<script type="text/javascript">
    
    var image = document.getElementById("imageProfil");
    var lien = document.getElementById("lienSurImage");
    var myForm = document.getElementById('formInscription'),
            inputs = document.getElementsByTagName('input'),
            inputsLength = inputs.length;
    
    function addEvent(element, event, func) {
 
        if (element.addEventListener) { // Si notre élément possède la méthode addEventListener()
            element.addEventListener(event, func, false);
        } else { // Si notre élément ne possède pas la méthode addEventListener()
            element.attachEvent('on' + event, func);
        } 
    }
    
    // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
    var check = {}; // On met toutes nos fonctions dans un objet littéral
    
    check['nom'] = function(id) {
        var name = document.getElementById(id);
        if (name.value.length >= 2) {
            return true;
        } else {
            return false;
        }
    };
    
    for (var i = 0 ; i < inputsLength ; i++) {
        if (inputs[i].type === 'text' || inputs[i].type === 'password') {
            inputs[i].onkeyup = function() {
                check[this.id](this.id); // "this" représente l'input actuellement modifié
            };
        }
    }
    
    /*addEvent(myForm,'submit',function(){
        var result = true;
        for (var i in check) {
            result = check[i](i) && result;
        }
        if (result) {
            return true;
        }
        return false;
    });*/
    
    // Evenement image
    addEvent(image,'mouseover',function(){
        lien.style.display = "block";
    });
    
    addEvent(image,'mouseout',function(){
        addEvent(lien,'mouseover',function(){
            lien.style.display = "block";
        });
        lien.style.display = "none";
    });
    
</script>