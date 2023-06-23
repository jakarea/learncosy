   // Get the required elements
   const uploadLabel3 = document.getElementById('upload-label3');
   const icon3 = document.getElementById('icon3');
   const imageInput3 = document.getElementById('image-input3');
   const uploadedImage3 = document.getElementById('uploaded-image3');
   const uploadedImagePreview3 = document.getElementById('uploaded-image-preview3');
   const uploadedImageName3 = document.getElementById('uploaded-image-name3');
   const closeIcon3 = document.getElementById('close-icon3');
   const staticImage3 = document.querySelector('.static-image3');
   
   // Add event listener to the image input
   imageInput3.addEventListener('change', handleImageUpload3);
   
   // Function to handle image upload
   function handleImageUpload3() {
     const file3 = this.files[0];
   
     // Check if a file was selected
     if (file3) {
       const reader = new FileReader();
       
       // Set the image source and name once it's loaded
       reader.onload = function(e) {
         uploadedImagePreview3.src = e.target.result;
         uploadedImageName3.textContent = file3.name;
         showUploadedImage3();
       }
       
       // Read the image file as a data URL
       reader.readAsDataURL(file3);
     }
   }
   
   // Function to show the uploaded image and name
   function showUploadedImage3() {
     staticImage3.style.display = 'none';
     uploadedImage3.style.display = 'block';
     icon3.classList.remove('fa-plus');
     icon3.classList.add('fa-times');
   }
   
   // Function to hide the uploaded image and reset the input
   function hideUploadedImage3() {
     staticImage3.style.display = 'block';
     uploadedImage3.style.display = 'none';
     uploadedImageName3.textContent = '';
     imageInput3.value = '';
     icon3.classList.remove('fa-times');
     icon3.classList.add('fa-plus');
   }
   
   // Add event listener to the close icon
   closeIcon3.addEventListener('click', hideUploadedImage3);