/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    $(function() {
        /*$( "#gestion-tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );*/
        
        $( "#gestion-tabs" ).tabs();
    });
    
    //$('#fenetre-images-membre').ready(function(){});
    
    $('#show-win-img-member').ready().click(function(){
        $('#fenetre-images-membre').ready().fadeIn();
    });
    
    $('#close-win-img-member').ready().click(function(){
        $('#fenetre-images-membre').ready().fadeOut();
    });
    
    var dropbox;  

    $("#dropbox").ready(function(){
        dropbox = document.getElementById("dropbox");
        if(dropbox){
            dropbox.addEventListener("dragenter", dragenter, false);  
            dropbox.addEventListener("dragleave", dragleave, false);  
            dropbox.addEventListener("dragover", dragover, false);  
            dropbox.addEventListener("drop", drop, false);
        }
        
    });
      
	
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
  
  $("#content-gestion-video").ready(function(){
    //alert('envoie');
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "?entity=video",
        /*success: function(data, textStatus, jqXHR) {
            // La reponse du serveur est contenu dans data
            // On peut faire ce qu'on veut avec ici
            console.log(jqXHR);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Une erreur s'est produite lors de la requete
            console.log(jqXHR);
        }*/
    }).done(function(data, textStatus, jqXHR){
        //console.log(data);
        //alert('sucess');
    }).fail(function(){
        //alert( "error" );
    }).always(function(){
        //alert( "complete" );
    });
    
  });
  
});
