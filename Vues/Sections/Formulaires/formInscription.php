<?php
    //var_dump($test);

?>
<form id="formInscription" method="POST" action="">
    <fieldset>
        <legend><?= $langForm['Inscription'];?></legend>
        <div id="form-div-nom">
            <label><?= $langForm['nom'];?></label>
            <input id="nom" type="text" name="inscription[nom]" />
            <span class="tooltip"><?= $langForm['tooltipNom'] ?></span>
        </div>
        <div id="form-div-prenom">
            <label><?= $langForm['prenom'];?></label>
            <input id="prenom" type="text" name="inscription[prenom]" />
            <span class="tooltip"><?= $langForm['tooltipPrenom'] ?></span>
        </div>
        <div id="form-div-naissance">
            <label><?= $langForm['naissance'];?></label>
            <input id="dateNaissance" type="text" name="inscription[dateNaissance]" maxlength="10" min="10" placeholder="<?= $langForm['dateFormat'];?>" />
            <span class="tooltip"><?= $langForm['tooltipDate'] ?></span>
        </div>
        <div class="form-div-identifiant">
            <label><?= $langForm['identifiant'];?></label>
            <input id="identifiant" type="text" name="inscription[identifiant]" />
            <span class="tooltip"><?= $langForm['tooltipId'] ?></span>
        </div>
        <div id="form-div-email">
            <label><?= $langForm['email'];?></label>
            <input id="email" type="text" name="inscription[email]" />
            <span class="tooltip"><?= $langForm['tooltipEmailInsc'] ?></span>
        </div>
        <div id="form-div-password">
            <label><?= $langForm['password'];?></label>
            <input id="password" type="password" name="inscription[password]" />
            <span class="tooltip"><?= $langForm['tooltipMp'] ?></span>
        </div>
        <div id="form-div-confirm">
            <label><?= $langForm['password'];?> (<?= $langTexte['repeter'];?>)</label>
            <input id="confirm" type="password" name="inscription[confirm]" />
            <span class="tooltip"><?= $langForm['tooltipMpC'] ?></span>
        </div>
        <div id="form-div-condition">
            <label><?= $langTexte['luAccepte'];?><a href=""><?= $langTexte['condiUti'];?></a></label>
            <input id="condition" type="checkbox" name="inscription[utilisation]" />
            <span class="tooltip"><?= $langForm['tooltipCondition'] ?></span>
        </div>
        <div class="btn-send">
            <input type="submit" value="<?= $langBtn['inscrire'];?>" />
            <input type="reset" value="<?= $langBtn['retablir'];?>" />
        </div>
    </fieldset>
</form>

<script type="text/javascript">
    
    function creationXHR(){
        var resultat = null;
        try{// test pour les navigateurs : Mozilla, OPera ...
            resultat = new XMLHttpRequest();
        }catch (Error){
            try{// test pour les navigateurs Internet Explorer > 5.0
                resultat = new ActiveXObject("Msxml2.XMLHTTP");
            }catch (Error){
                try{// test pour les navigateurs Internet Explorer 5.0
                    resultat = new ActiveXObject("Microsoft.XMLHTTP");
                }catch (Error){
                    resultat = null;
                }
            }
        }
        return resultat;
    }
    
    // fonction pour verifier la validé de la date.
    function checkDate(element){
        var date = element.value;
        //ex : jj/mm/aaaa
        //var format = /^(\d{1,2}\/){2}\d{4}$/;
        //ex : aaaa-mm-jj
        var format = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
        if(!format.test(date)){
            return false;
        }
        else{
            var date_temp = date.split('-');
            date_temp[1] -=1;        // On rectifie le mois !!!
            var ma_date = new Date();
            ma_date.setFullYear(date_temp[0]);
            ma_date.setMonth(date_temp[1]);
            ma_date.setDate(date_temp[2]);
            if(ma_date.getFullYear()==date_temp[0] && ma_date.getMonth()==date_temp[1] && ma_date.getDate()==date_temp[2]){
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    // Fonction de désactivation de l'affichage des "tooltips"
    function deactivateTooltips() {
        var spans = document.getElementsByTagName('span'),
        spansLength = spans.length;

        for (var i = 0 ; i < spansLength ; i++) {
            if (spans[i].className === 'tooltip') {
                spans[i].style.display = 'none';
            }
        }
    }


    // La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à notre input
    function getTooltip(elements) {
        while (elements = elements.nextSibling) {
            if (elements.className === 'tooltip') {
                return elements;
            }
        }

        return false;
    }
    
    // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
    var check = {}; // On met toutes nos fonctions dans un objet littéral

    check['nom'] = function(id) {
        var name = document.getElementById(id),
            tooltipStyle = getTooltip(name).style;
        if (name.value.length >= 2) {
            name.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            name.className = 'incorrect';
            tooltipStyle.display = 'block';
            return false;
        }
    };

    check['prenom'] = check['nom']; // La fonction pour le prénom est la même que celle du nom
    
    check['dateNaissance'] = function(id){
        var date = document.getElementById(id),
            tooltipStyle = getTooltip(date).style;
        
        if(checkDate(date)){
            date.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        }
        else{
            date.className = 'incorrect';
            tooltipStyle.display = 'block';
            return false;
        }
    };
    
    check['identifiant'] = function(id, reponse) {
        var login = document.getElementById(id),
            tooltipStyle = getTooltip(login).style;

        if (login.value.length >= 4 && login.value.length <= 21 && reponse === "no member") {
            login.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            login.className = 'incorrect';
            if(reponse !== "" && reponse !== "no member") getTooltip(login).innerHTML = login.value +'<?= $langForm['tooltipMember'] ?>';
            else getTooltip(login).innerHTML = '<?= $langForm['tooltipId'] ?>';
            tooltipStyle.display = 'block';
            return false;
        }
    };

    check['email'] = function(id, reponse){
        var email = document.getElementById(id),
            tooltipStyle = getTooltip(email).style;
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        //alert(reponse);
        if(filter.test(email.value) && reponse === "no member"){
            email.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            email.className = 'incorrect';
            if(reponse !== "" && reponse !== "no member") getTooltip(email).innerHTML = email.value +'<?= $langForm['tooltipMember'] ?>';
            else getTooltip(email).innerHTML = '<?= $langForm['tooltipEmailInsc'] ?>';
            tooltipStyle.display = 'block';
            return false;
        }
    };
    
    check['password'] = function(id) {

        var pwd1 = document.getElementById(id),
            tooltipStyle = getTooltip(pwd1).style;

        if (pwd1.value.length >= 8) {
            pwd1.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            pwd1.className = 'incorrect';
            tooltipStyle.display = 'block';
            return false;
        }

    };

    check['confirm'] = function(id) {

        var pwd1 = document.getElementById('password'),
            pwd2 = document.getElementById(id),
            tooltipStyle = getTooltip(pwd2).style;

        if (pwd1.value === pwd2.value && pwd2.value !== '') {
            pwd2.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            pwd2.className = 'incorrect';
            tooltipStyle.display = 'block';
            return false;
        }

    };
    
    check['condition'] = function(id){
        var condition = document.getElementById(id),
            tooltipStyle = getTooltip(condition).style;
    
        if(condition.checked){
            tooltipStyle.display = 'none';
            return true;
        }
        else{
            tooltipStyle.display = 'block';
            return false;
        }
    };
    
    // Mise en place des événements  
    (function() { // Utilisation d'une fonction anonyme pour éviter les variables globales.
        var myForm = document.getElementById('formInscription'),
            inputs = document.getElementsByTagName('input'),
            inputsLength = inputs.length;
        var objetXHR = creationXHR();
        var id;
        

        for (var i = 0 ; i < inputsLength ; i++) {
            if (inputs[i].type === 'text' || inputs[i].type === 'password') {
               
                if(inputs[i].id === 'identifiant' || inputs[i].id === 'email'){
                    inputs[i].onkeyup = function() {
                        if(this.value !== ""){
                            objetXHR.open("get","./verifieMembre.php?method=inscription&"+this.id+"="+this.value,"true");
                            objetXHR.send(null);
                            id = this.id;
                        }
                    };
                    
                    objetXHR.onreadystatechange = function(){
                        if(this.readyState === 4){
                            if(this.status === 200){
                                check[id](id,this.responseText);
                            }
                        }
                    };
                }
                else{
                    inputs[i].onkeyup = function() {
                        check[this.id](this.id); // "this" représente l'input actuellement modifié
                    };
                }
            }
        }

        myForm.onsubmit = function() {
            var result = true;

            for (var i in check) {
                if(i === 'identifiant' || i === 'email') result = check[i](i,'no member') && result;
                else result = check[i](i) && result;
            }
            if (result) {
                return true;
            }
            return false;
        };
        
        myForm.onreset = function() {
            for (var i = 0 ; i < inputsLength ; i++) {
                if (inputs[i].type === 'text' || inputs[i].type === 'password') {
                    inputs[i].className = '';
                }
            }
            deactivateTooltips();
        };

    })();

    // Maintenant que tout est initialisé, on peut désactiver les "tooltips"
    deactivateTooltips();
    
</script>