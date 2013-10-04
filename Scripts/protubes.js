
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