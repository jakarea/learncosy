@extends('layouts.latest.admin')
@section('title') Student Profile Edit Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === user update page @S === -->
<main class="profile-update-page">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-md-7">
                <div class="user-header">
                    <h2>Update {{ $student->name }} Profile</h2>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="user-header-bttn">
                    <a href="{{url('admin/students')}}"><img src="{{asset('latest/assets/images/icons/user.svg')}}"
                            alt="user" class="img-fluid"> All Students </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="user-add-form-wrap">
                    {{-- user update form @s --}}
                    <form action="{{route('admin.updateStudentProfile',$student->id)}}" method="POST" class="profile-form create-form-box" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="name">Name <sup class="text-danger">*</sup>
                                    </label> 
                                        <input type="text" placeholder="Enter your Name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $student->name }}" id="name">
                                     
                                    <span class="invalid-feedback">@error('name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <label for="phone">Phone <sup class="text-danger">*</sup>
                                    </label> 
                                        <input type="text" placeholder="Enter Phone Number" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ $student->phone }}" id="phone">
                                     
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
                                            value="{{ $student->email }}" id="email" disabled>
                                    
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
                                    <label for="short_bio">Short Bio 
                                    </label> 
                                        <textarea name="short_bio" id="short_bio"
                                            class="form-control @error('short_bio') is-invalid @enderror"
                                            placeholder="Enter short bio">{{ $student->short_bio }}</textarea>
                                     
                                    <span class="invalid-feedback">@error('short_bio'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">  
                                <div class="form-group">
                                    <label for="features" class="mb-1">Social Media </label> 
                                    @php $socialLinks = explode(",",$student->social_links); @endphp 
                                    <input type="text" placeholder="Enter Social Link" name="social_links[]"
                                        class="form-control @error('social_links') is-invalid @enderror"
                                        id="features" multiple> 
                                    <div class="url-extra-field">
                                        @foreach ($socialLinks as $social)
                                        <div>
                                            <input class="form-control" multiple="" type="url" placeholder="Enter Social Link" name="social_links[]" value="{{ $social }}"> 
                                        </div>
                                        @endforeach
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
                                            placeholder="Enter Full Description">{{ $student->description }}</textarea>
                                    
                                    <span class="invalid-feedback">@error('description'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 

                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-0">
                                    <label for="">Avatar</label>
                                </div>
                                <div id="image-container">
                                    <label for="imageInput" class="upload-box">
                                        <span>
                                            <img src="{{asset('latest/assets/images/icons/camera-plus.svg')}}"
                                                alt="Upload" class="img-fluid">
                                            <p>Upload photo</p>
                                        </span>
                                    </label>
                                    <input type="file" name="avatar" id="imageInput" accept="image/*"
                                        onchange="displayImage(event)" class="d-none">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-2">
                                    <label for="">Uploaded Image</label>
                                </div>
                                <div id="imageContainer">
                                    <span id="closeIcon" onclick="removeImage()">&#10006;</span>
                                    @if ($student->avatar)
                                    <img src="{{asset('assets/images/users/'.$student->avatar)}}" alt="No Image"
                                        class="img-fluid d-block" id="uploadedImage">
                                    @else
                                    <img src="{{asset('latest/assets/images/avatar.png')}}" alt="No Image"
                                        class="img-fluid d-block" id="uploadedImage">
                                    @endif 
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="recivingMessage">Receiving Messages: </label>
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault1" value="1" {{ $student->recivingMessage == 1
                                                ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Enable
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault2" value="0" {{ $student->recivingMessage == 0
                                                ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </div> 
                                    <span class="invalid-feedback">@error('recivingMessage'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="form-group mt-3">
                                    <label for="">Initial Password for this Student </label>
                                    <input type="text" class="form-control " value="1234567890" disabled> 
                                    <span class="can-change">*Can be Change it Later</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-submit-bttns">
                                    <button type="reset" class="btn btn-cancel">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- user update form @e --}}
                </div>
            </div>
        </div>
    </div>
</main>
<!-- === user update page @E === -->

@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js">
</script>
<script src="{{asset('assets/js/tinymce.js')}}"></script>
<script src="{{asset('latest/assets/js/user-image-upload.js')}}"></script>
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
      linkk.setAttribute("onclick", "removeField(this)");
      div.appendChild(node);
      div.appendChild(linkk);
  
      extraFileds.appendChild(div);
    }
  
    const removeField = (element) => {
      element.parentElement.style.display = 'none';
    }
  
    urlBttn.addEventListener('click', createFiled, true);
  
    // Show the minus icon for the existing input fields in the loop
    const existingInputs = document.querySelectorAll('.url-extra-field input');
    for (const input of existingInputs) {
      let linkk = document.createElement("a");
      linkk.innerHTML = "<i class='fas fa-minus'></i>";
      linkk.setAttribute("onclick", "removeField(this)");
  
      let div = document.createElement("div");
      div.appendChild(input);
      div.appendChild(linkk);
      
      extraFileds.appendChild(div);
    }
  </script>
  
@endsection
{{-- page script @E --}}