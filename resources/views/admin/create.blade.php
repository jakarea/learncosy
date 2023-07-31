@extends('layouts.latest.admin')
@section('title') Admin Add Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === admin add page @S === -->
<main class="profile-create-page">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="user-header">
                    <h2>Add an Admin</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="user-header-bttn">
                    <a href="{{url('admin/alladmin')}}"><img src="{{asset('latest/assets/images/icons/user.svg')}}"
                            alt="user" class="img-fluid"> All Admin </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- user add form start --}}
                <div class="user-add-form-wrap">
                    <form action="{{route('allAdmin.add')}}" method="POST" class="profile-form create-form-box"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="name">Name: <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" placeholder="Enter Name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" id="name">
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
                                    <label for="short_bio">Short Bio
                                    </label>
                                       
                                        <textarea name="short_bio" id="short_bio"
                                            class="form-control @error('short_bio') is-invalid @enderror"
                                            placeholder="Enter short bio">{{ old('short_bio') }}</textarea>
                                   
                                    <span class="invalid-feedback">@error('short_bio'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="features" class="mb-1">Social Media: </label>
                                        
                                    <input type="text" placeholder="Enter Social Link" name="social_links[]"
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
                                    <label for="description" class="mb-2">Description: </label>
                                      
                                        <textarea name="description" id="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter Full Description">{{ old('description') }}</textarea>
                                     
                                    <span class="invalid-feedback">@error('description'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6"> 
                                <div class="form-group m-0">
                                    <label for="">Sample Certificates</label>
                                </div>
                                <div id="image-container">
                                    <label for="image-input" id="upload-label">
                                        <img src="{{asset('latest/assets/images/upload-img.svg')}}" alt="Upload" class="img-fluid">
                                    </label> 
                                    <input type="file" name="avatar" id="image-input" style="display: none;">
                                    <div id="uploaded-image" style="display: none;">
                                        <img id="uploaded-image-preview" alt="Uploaded Image">

                                        <i id="close-icon" class="fas fa-times"></i>
                                    </div> 
                                    

                                </div>
                                <span id="uploaded-image-name"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0 mt-3">
                                    <label for="recivingMessage">Receiving Messages: </label> 
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="radio" name="recivingMessage"
                                                id="flexRadioDefault1" value="1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Enable
                                            </label>
                                        </div>
                                        <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="recivingMessage"
                                                id="flexRadioDefault2" value="0">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Disable
                                            </label>
                                        </div>
                                     
                                    <span class="invalid-feedback">@error('recivingMessage'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="custom-hr">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="">Initial Password for this Admin : <code
                                            class="bg-danger text-white p-1">1234567890</code> </label>
                                    <sup>*Can be Change it Later</sup>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="submit-bttns">
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- user add form end --}}
            </div>
        </div>
    </div>
</main>
<!-- === admin add page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="{{asset('assets/js/image-upload.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
<script>
    // JavaScript
const urlBttn = document.querySelector('#url_increment');
let extraFields = document.querySelector('.url-extra-field'); 

const createField = () => { 
  let div = document.createElement("div");
  let node = document.createElement("input"); 
  node.setAttribute("class", "form-control w-100 @error('social_links') is-invalid @enderror");
  node.setAttribute("multiple", ""); 
  node.setAttribute("type", "url"); 
  node.setAttribute("placeholder", "Enter Social Link"); 
  node.setAttribute("name", "social_links[]");    
  let link = document.createElement("a");
  link.innerHTML = "<i class='fas fa-minus'></i>";
  link.addEventListener("click", () => removeField(div));
  
  div.appendChild(node);
  div.appendChild(link);
  extraFields.appendChild(div);
}

const removeField = (field) => {
  // Remove the input field from the form
  field.remove();
}

urlBttn.addEventListener('click', createField, true);

</script>
@endsection

{{-- page script @E --}}