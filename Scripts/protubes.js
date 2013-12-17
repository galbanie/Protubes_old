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

$(document).ready(function(){	
	var dropbox;  
	  
	dropbox = document.getElementById("dropbox");  
	dropbox.addEventListener("dragenter", dragenter, false);  
	dropbox.addEventListener("dragleave", dragleave, false);  
	dropbox.addEventListener("dragover", dragover, false);  
	dropbox.addEventListener("drop", drop, false);  
	
	function defaults(e){
       e.stopPropagation();  
       e.preventDefault();  
	}
    function dragenter(e) {  
	   $(this).addClass("active");
	   defaults(e);
	}  
      
    function dragover(e) { 
	   defaults(e);
    }  
    function dragleave(e) {  
	   $(this).removeClass("active");
	   defaults(e);
    }  

    function drop(e) {  
	   $(this).removeClass("active");
	   defaults(e);
      
	   // dataTransfer -> which holds information about the user interaction, including what files (if any) the user dropped on the element to which the event is bound.
	   //console.log(e);
       var dt = e.dataTransfer;  
       var files = dt.files;  
      
       handleFiles(files,e);  
    }  
   
	handleFiles = function (files,e){
		// alert(files);
		// Traverse throught all files and check if uploaded file type is image	
		var imageType = /image.*/;  
		var file = files[0];
		// check file type
		if (!file.type.match(imageType)) {  
		  alert("File \""+file.name+"\" is not a valid image file, Are you trying to screw me :( :( ");
		  return false;	
		} 
		// check file size
		if (parseInt(file.size / 1024) > 2050) {  
		  alert("File \""+file.name+"\" is too big. I am using shared server :P");
		  return false;	
		} 
		
		var info = '<div class="preview active-win"><div class="preview-image"><img ></div><div class="progress-holder"><span id="progress"></span></div><span class="percents"></span><div style="float:left;">Uploaded <span class="up-done"></span> KB of '+parseInt(file.size / 1024)+' KB</div>';
		
		$(".upload-progress").show("fast",function(){
			$(".upload-progress").html(info); 
			uploadFile(file);
		});
		
  }

  uploadFile = function(file){
	// check if browser supports file reader object 
	if (typeof FileReader !== "undefined"){
	//alert("uploading "+file.name);  
	reader = new FileReader();
	reader.onload = function(e){
		//alert(e.target.result);
		$('.preview img').attr('src',e.target.result).css("width","70px").css("height","70px");
	}
	reader.readAsDataURL(file);

	xhr = new XMLHttpRequest();
	xhr.open("post", "ajax_fileupload.php", true);

	xhr.upload.addEventListener("progress", function (event) {
		console.log(event);
		if (event.lengthComputable) {
			$("#progress").css("width",(event.loaded / event.total) * 100 + "%");
			$(".percents").html(" "+((event.loaded / event.total) * 100).toFixed() + "%");
			$(".up-done").html((parseInt(event.loaded / 1024)).toFixed(0));
		}
		else {
			alert("Failed to compute file upload length");
		}
	}, false);

	xhr.onreadystatechange = function (oEvent) {  
	  if (xhr.readyState === 4) {  
		if (xhr.status === 200) {  
		  $("#progress").css("width","100%");
		  $(".percents").html("100%");
		  $(".up-done").html((parseInt(file.size / 1024)).toFixed(0));
		} else {  
		  alert("Error"+ xhr.statusText);  
		}  
	  }  
	};  
	
	// Set headers
	xhr.setRequestHeader("Content-Type", "multipart/form-data");
	xhr.setRequestHeader("X-File-Name", file.fileName);
	xhr.setRequestHeader("X-File-Size", file.fileSize);
	xhr.setRequestHeader("X-File-Type", file.type);

	// Send the file (doh)
	xhr.send(file);

	}else{
		alert("Your browser doesnt support FileReader object");
	} 		
  }
});