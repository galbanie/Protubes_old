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

// demarrage du chargement
function demarrageChargement(form){
    if(checkElementDOM(form,'FORM')){
        var data = new FormData(form);
        var objetXHR = creationXHR();
        
        addEvent(objetXHR,'progress',updateProgress);
        addEvent(objetXHR,'load',transfertComplete);
        addEvent(objetXHR,'error',transfertFailed);
        addEvent(objetXHR,'abort',transfertCanceled);
        
        objetXHR.open('POST', form.action);
        objetXHR.send(data);
    }
}

function updateProgress(e){
    if(e.lengthComputable){
        
    }
    else{
        
    }
}

function transfertComplete(){
    
}

function transfertFailed(){
    
}

function transfertCanceled(){
    
}