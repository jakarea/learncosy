@extends('layouts.latest.admin')
@section('title') Instructor Add Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Instructor add page @S === -->
<main class="profile-create-page">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="user-header">
                    <h2>Add  new Instructor</h2>
                </div>
            </div>
            <div class="col-6">
                <div class="user-header-bttn">
                    <a href="{{url('admin/instructor')}}"><img src="{{asset('latest/assets/images/icons/user.svg')}}"
                            alt="user" class="img-fluid"> All Instructor </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="user-add-form-wrap">
                    <form action="{{route('instructor.add')}}" method="POST" class="profile-form create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <label for="name" >Name <sup class="text-danger">*</sup></label>
                                        <input type="text" placeholder="Enter Name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name">
                                     
                                    <span class="invalid-feedback">@error('name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <div class="d-flex mb-2 justify-content-between">
                                        <label for="subdomain" class="mb-0">Subdomain </label>
                                        
                                    </div> 
                                        
                                        <input type="text" placeholder="Enter Subdomain" name="subdomain"
                                            class="form-control @error('subdomain') is-invalid @enderror"
                                            value="{{ old('subdomain') }}" id="subdomain"> 
                                    <span class="invalid-feedback">@error('subdomain'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <label for="phone">Phone <sup class="text-danger">*</sup>
                                    </label>
                                        
                                        <input type="text" placeholder="Enter Phone Number" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" id="phone">
                                
                                    <span class="invalid-feedback">@error('phone'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <label for="email">Email <sup class="text-danger">*</sup>
                                    </label>
                                        
                                        <input type="email" placeholder="Enter email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" id="email">
                                     
                                    <span class="invalid-feedback">@error('email'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="custom-hr">
                                    <hr>
                                    <h5>Other Information </h5> 
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="company_name">Company Name 
                                    </label>
                                        
                                        <input type="text" placeholder="Company Name" name="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            value="{{ old('company_name') }}" id="company_name">
                                     
                                    <span class="invalid-feedback">@error('company_name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="website">Website 
                                    </label>
                                        
                                        <input type="text" placeholder="Enter Web Address" name="website"
                                            class="form-control @error('website') is-invalid @enderror"
                                            value="{{ old('website') }}" id="website">
                                     
                                    <span class="invalid-feedback">@error('website'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="features" class="mb-1">Social Media </label>

                                    <input type="url" placeholder="Enter Social Link" name="social_links[]"
                                        class="form-control w-100 @error('social_links') is-invalid @enderror"
                                        id="features" multiple value="">

                                    <div class="url-extra-field">
                                    </div>

                                    <span class="invalid-feedback">@error('social_links'){{ $message }}
                                        @enderror</span>
                                    <a href="javascript:void(0)" id="url_increment"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description" class="mb-2">About </label>

                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Type here..">{{ old('description') }}</textarea>

                                    <span class="invalid-feedback">@error('description'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-0">
                                    <label for="avatar">Avatar</label>
                                </div>
                                <div id="image-container" class="drop-container">
                                    <label for="avatar" class="upload-box">
                                        <span>
                                            <img src="{{asset('latest/assets/images/icons/camera-plus.svg')}}"
                                                alt="Upload" class="img-fluid">
                                            <p>Upload photo</p>
                                        </span>
                                    </label>
                                    <input type="file" name="avatar" accept="image/*" id="avatar" class="d-none">
                                    <span class="invalid-feedback">@error('avatar'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-2">
                                    <label for="avatar">Uploaded Image</label>
                                </div>
                                <div id="imageContainer" class="drop-container">
                                    <span id="closeIcon" onclick="removeImage()" style="display: none;">&#10006;</span>
                                    <img src="" alt="" class="img-fluid d-block" id="uploadedImage"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recivingMessage">Receiving Messages: </label>
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault1" value="1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Enable
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault2" value="0">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </div> 
                                    <span class="invalid-feedback">@error('recivingMessage'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>`
                            <div class="col-lg-12">
                                <div class="form-group mt-3">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="**********">  
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-submit-bttns">
                                    <button type="reset" class="btn btn-cancel">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</main>
<!-- === Instructor add page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/your-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>;
<script>
    var isDarkMode = document.body.classList.contains('dark-mode');

    // Initialize TinyMCE with the correct mode
    tinymce.init({
        selector: '#description',
        plugins: 'powerpaste casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
        toolbar: 'undo redo print spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify lineheight | checklist bullist numlist indent outdent | removeformat',
        height: '300px',
        skin: isDarkMode ? "oxide-dark" : "oxide",
        content_css: isDarkMode ? "dark" : "default",

    });
</script>

{{-- drag & drop image upload js --}}
<script>
    function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        const files = evt.dataTransfer ? evt.dataTransfer.files : evt.target.files;

        if (files.length > 0) {
        const file = files[0];

        if (!file.type.match('image.*')) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            const imageContainer = document.getElementById('imageContainer');
            imageContainer.innerHTML = '';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('img-fluid', 'd-block');
            img.id = 'uploadedImage';

            imageContainer.appendChild(img);

            const closeIcon = document.createElement('span');
            closeIcon.innerHTML = '&#10006;';
            closeIcon.id = 'closeIcon';
            closeIcon.onclick = removeImage;

            imageContainer.appendChild(closeIcon);

            // Show the close icon
            closeIcon.style.display = 'inline';
        };

        reader.readAsDataURL(file);
        }
        }

        document.getElementById('avatar').addEventListener('change', handleFileSelect);

        function removeImage() {
        const imageContainer = document.getElementById('imageContainer');
        imageContainer.innerHTML = '';
        document.getElementById('avatar').value = '';

        const closeIcon = document.getElementById('closeIcon');
        closeIcon.style.display = 'none'; // Hide the close icon
        }

        const dropContainers = document.querySelectorAll('.drop-container');
        dropContainers.forEach(function (dropContainer) {
        dropContainer.addEventListener('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        });

        dropContainer.addEventListener('drop', handleFileSelect);
        });

</script>


<script>
    const urlBttn = document.querySelector('#url_increment');
    let extraFileds = document.querySelector('.url-extra-field'); 
    const createFiled = () => { 
      let div = document.createElement("div");
      let node = document.createElement("input"); 
      node.setAttribute("class", "form-control w-100 @error('social_links') is-invalid @enderror");
      node.setAttribute("multiple", ""); 
      node.setAttribute("type", "url"); 
      node.setAttribute("placeholder", "Enter Social Link"); 
      node.setAttribute("name", "social_links[]");    
      let linkk = document.createElement("a");
      linkk.innerHTML = "<i class='fas fa-minus'></i>";
      linkk.setAttribute("onclick", "this.parentElement.style.display = 'none';");
      let divNew = extraFileds.appendChild(div);
      divNew.appendChild(node);
      divNew.appendChild(linkk);
    }
  
    urlBttn.addEventListener('click',createFiled,true);
  
   
</script>
@endsection

{{-- page script @E --}}