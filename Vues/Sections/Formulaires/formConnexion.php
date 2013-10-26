<?php

//print_r($_POST);

?>

<form id="formConnexion" method="POST" action="">
    <fieldset>
        <legend><?= $langForm['Connexion'];?></legend>
        <div id="form-div-email">
            <label><?= $langForm['email'];?></label>
            <input id="email" type="text" name="connexion[email]" value="<?php echo (isset($_REQUEST['connexion']['email']))? $_REQUEST['connexion']['email'] : ''; ?>" />
            <span class="tooltip"><?= $langForm['tooltipEmailCon'] ?></span>
        </div>
        <div id="form-div-password">
            <label><?= $langForm['password'];?></label>
            <input id="password" type="password" name="connexion[password]" value="<?php echo (isset($_REQUEST['connexion']['email']))? $_REQUEST['connexion']['password'] : ''; ?>" />
            <span class="tooltip"><?= $langForm['tooltipMpCon'] ?></span>
        </div>
        <div>
            <label><?= $langForm['pswPerdu'];?><a href=""><?= $langTexte['cliquezIci'];?></a></label>
        </div>
        <div class="btn-send">
            <input type="submit" value="<?= $langBtn['signIn'];?>" />
        </div>
    </fieldset>
</form>

<script type="text/javascript">
    
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
    // Maintenant que tout est initialisé, on peut désactiver les "tooltips"
    //deactivateTooltips();
    
    // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
    var check = {}; // On met toutes nos fonctions dans un objet littéral

    check['email'] = function(id,connectError){
        var email = document.getElementById('email'),
            tooltipStyle = getTooltip(email).style;
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        //alert(connectError+ ' email');
        if(filter.test(email.value) && connectError !== 'email error'){
            email.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            email.className = 'incorrect';
            if(connectError === 'email error') getTooltip(email).innerHTML = "<?= $langForm['tooltipEmailNoCon'] ?>";
            else getTooltip(email).innerHTML = "<?= $langForm['tooltipEmailCon'] ?>";
            tooltipStyle.display = 'block';
            return false;
        }
    };

    check['password'] = function(id,connectError) {
        var pwd1 = document.getElementById('password'),
            tooltipStyle = getTooltip(pwd1).style;
        
        
        //alert(connectError+' pwd');
        if (pwd1.value.length > 0 && connectError !== 'pwd error') {
            pwd1.className = 'correct';
            tooltipStyle.display = 'none';
            return true;
        } else {
            pwd1.className = 'incorrect';
            if(connectError === 'pwd error') getTooltip(pwd1).innerHTML = "<?= $langForm['tooltipMpNoCon'] ?>";
            else getTooltip(pwd1).innerHTML = "<?= $langForm['tooltipMpCon'] ?>";
            tooltipStyle.display = 'block';
            return false;
        }

    };
    
    // Mise en place des événements  
    (function() { // Utilisation d'une fonction anonyme pour éviter les variables globales.
        var myForm = document.getElementById('formConnexion');
        /*var inputs = document.getElementsByTagName('input'),
            inputsLength = inputs.length;*/
        var connectError = '<?php if(isset($connectError)) echo $connectError;else echo ''; ?>';
        
        //alert(connectError);
        //if(connectError !== ''){
            /*for (var i = 0 ; i < inputsLength ; i++) {
                if (inputs[i].type === 'text' || inputs[i].type === 'password'){
                    inputs[i].onload = function() {
                        check[this.id](this.id,connectError); // "this" représente l'input actuellement modifié
                    };
                }
            }*/
        //}
        
        myForm.onsubmit = function() {
            var result = true;
            
            connectError = '';
            for (var i in check) {
                result = check[i](i,connectError) && result;
            }
            if (result) {
                return true;
            }
            return false;
        };

    })();

    // Maintenant que tout est initialisé, on peut désactiver les "tooltips"
    deactivateTooltips();
    
    window.onload = function(){
        var connectError = '<?php if(isset($connectError)) echo $connectError;else echo ''; ?>';
        if(connectError !== ''){
            check['email']('email',connectError);
            check['password']('password',connectError);
        }
        
    };

</script>