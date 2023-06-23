   // Get the required elements
   const uploadLabel2 = document.getElementById('upload-label2');
   const icon2 = document.getElementById('icon2');
   const imageInput2 = document.getElementById('image-input2');
   const uploadedImage2 = document.getElementById('uploaded-image2');
   const uploadedImagePreview2 = document.getElementById('uploaded-image-preview2');
   const uploadedImageName2 = document.getElementById('uploaded-image-name2');
   const closeIcon2 = document.getElementById('close-icon2');
   const staticImage2 = document.querySelector('.static-image2');
   
   // Add event listener to the image input
   imageInput2.addEventListener('change', handleImageUpload2);
   
   // Function to handle image upload
   function handleImageUpload2() {
     const file2 = this.files[0];
   
     // Check if a file was selected
     if (file2) {
       const reader = new FileReader();
       
       // Set the image source and name once it's loaded
       reader.onload = function(e) {
         uploadedImagePreview2.src = e.target.result;
         uploadedImageName2.textContent = file2.name;
         showUploadedImage2();
       }
       
       // Read the image file as a data URL
       reader.readAsDataURL(file2);
     }
   }
   
   // Function to show the uploaded image and name
   function showUploadedImage2() {
     staticImage2.style.display = 'none';
     uploadedImage2.style.display = 'block';
     icon2.classList.remove('fa-plus');
     icon2.classList.add('fa-times');
   }
   
   // Function to hide the uploaded image and reset the input
   function hideUploadedImage2() {
     staticImage2.style.display = 'block';
     uploadedImage2.style.display = 'none';
     uploadedImageName2.textContent = '';
     imageInput2.value = '';
     icon2.classList.remove('fa-times');
     icon2.classList.add('fa-plus');
   }
   
   // Add event listener to the close icon
   closeIcon2.addEventListener('click', hideUploadedImage2);