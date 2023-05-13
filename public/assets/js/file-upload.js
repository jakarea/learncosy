
window.onload = function(){
        
    //Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        var filesInput = document.getElementById("files");
        
        filesInput.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("imgThumbnailPreview");
            
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];
                
                //Only pics
                if(!file.type.match('image'))
                  continue;
                
                var picReader = new FileReader();
                
                picReader.addEventListener("load",function(event){
                    
                    var picSrc = event.target.result;
                    
                    var imgThumbnailElem = "<div class='imgThumbContainer'><div class='IMGthumbnail' >";  
                    // var imgThumtwo = `<a href="javascript:void(0)" onclick="this.parentElement.parentElement.style.display = 'none' ">X`;
                    var imgThumtwo = `<a href="javascript:void(0)" onclick="this.parentElement.parentElement.remove(); ">X`;

                    var imgThumthree = "<img  src='" + picSrc + "'/>";
                    
                    output.innerHTML = output.innerHTML + imgThumbnailElem + imgThumtwo + imgThumthree;  
                
                });
                
                 //Read the image
                picReader.readAsDataURL(file);
            }                               
           
        });
    }
    else
    {
        alert("Your browser does not support File API");
    }
}
    