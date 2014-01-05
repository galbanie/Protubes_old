// Variables globales
var iMaxFilesize = 756000; // 750 Kb max taille image
var vMaxFilesize = 104857600; // 100 Mb max taille video
var timer = 0;

// fonction générique de création d'un objet XMLHttpRequest
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

// fonction générique d'ajout d'évènement à un élémént DOM
function addEvent(element, event, func) {
    if (element.addEventListener) { // Si notre élément possède la méthode addEventListener()
        element.addEventListener(event, func, false);
    } else { // Si notre élément ne possède pas la méthode addEventListener()
        element.attachEvent('on' + event, func);
    } 
}

// affiche et cache un element de type block
function showHideElementBlock(id){
    
    var element = document.getElementById(id);
    
    if(element !== null){
        var display = element.style.display;
        
        if(display === "block"){
            element.style.display = "none";
        }
        else if (display === "none"){
            element.style.display = "block";
        }
    }
}

// verifie si l'element est dans le DOM et son tag
function checkElementDOM(element, tag){
    if(element.nodeType === 1){
        if(element.tagName === tag){
            return true;
        }
    }
    return false;
}

// declenche la fenetre de chargement d'un fichier
function declencheChargement(form){
    if(checkElementDOM(form,'FORM')){
        form.fichier.click();
    }
}

function fichierSelected(input){
    if(checkElementDOM(input,'INPUT') && input.type === 'file'){
        var file = input.files[0];
        var type;
        
        var rFilter = /^(image\/bmp|image\/gif|image\/jpeg|image\/png|image\/tiff)$/i;
        if (rFilter.test(file.type)) {
            type = 'image';
        }
        else{
            rFilter = /^(video\/mpeg|video\/mp4|video\/quicktime|video\/x-ms-wmv|video\/x-msvideo|video\/x-flv)$/i;
            if (rFilter.test(file.type)) {
                type = 'video';
            }
            else return false;
        }
        
        switch (type){
            case 'image':
                if (file.size > iMaxFilesize) {
                    return false;
                }
            break;
            case 'video':
                if (file.size > vMaxFilesize) {
                    return false;
                }
            break;
        }
        
        return true;
    }
    return false;
}

// demarrage du chargement
function demarrageChargement(form){
    if(checkElementDOM(form,'FORM')){
        var data = new FormData(form);
        var objetXHR = creationXHR();
        
        addEvent(objetXHR.upload,'progress',updateProgressImage);
        addEvent(objetXHR,'load',transfertCompleteImage);
        addEvent(objetXHR,'error',transfertFailedImage);
        addEvent(objetXHR,'abort',transfertCanceledImage);
        
        //alert(form.action);
        
        objetXHR.open('POST', form.action);
        objetXHR.send(data);
        
        // set inner timer
        //timer = setInterval(doInnerUpdates, 300);
    }
}

function updateProgressImage(){
    document.imageProfil.src = 'Styles/images/big-loader.gif';
}

function transfertCompleteImage(e){
    //alert(e.target.responseText);
    //document.imageProfil.src = "Ressources/Images/Profil_default.jpg";
    
    document.imageProfil.src = e.target.responseText;
    document.imgUserEspMembre.src = e.target.responseText;
    
    
}

function transfertFailedImage(){
    alert('fail');
}

function transfertCanceledImage(){
    alert('cancel');
}