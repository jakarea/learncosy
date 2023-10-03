@extends('layouts.latest.admin')
@section('title') My Profile Edit @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Instructor update page @S === -->
<main class="profile-update-page">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-sm-7 col-md-7">
                <div class="user-header">
                    <h2>Update Your Profile</h2>
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5">
                <div class="user-header-bttn">
                    <a href="{{url('admin/profile/change-password')}}"> <i class="fas fa-lock-open me-2"></i> Update Password </a>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-12">
                <div class="user-add-form-wrap">
                    {{-- user update form @s --}}
                    <form action="{{route('admin.profile.update',$user->id)}}" method="POST"
                        class="profile-form create-form-box" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="name">Name <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" placeholder="Enter your Name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $user->name }}" id="name">

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
                                        value="{{ $user->phone }}" id="phone">

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
                                        value="{{ $user->email }}" id="email" disabled>

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
                                    <label for="company_name">Company name </label>

                                    <input type="text" name="company_name" id="company_name" value="{{  $user->company_name }}"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        placeholder="Company Name">

                                    <span class="invalid-feedback">@error('company_name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="website">Website </label>

                                    <input type="url" name="website" id="website" value="{{  $user->short_bio }}"
                                        class="form-control @error('website') is-invalid @enderror"
                                        placeholder="Enter Website">

                                    <span class="invalid-feedback">@error('website'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="social_links" class="mb-1">Social Media </label>
                                    @php $socialLinks = explode(",",$user->social_links); @endphp
                                    
                                    <div class="url-extra-field">
                                        @foreach ($socialLinks as $social)
                                        <div>
                                            <input class="form-control" multiple="" type="url"
                                                placeholder="Enter Social Link" name="social_links[]"
                                                value="{{ $social }}">
                                        </div>
                                        @endforeach
                                    </div>
                                    <span class="invalid-feedback">@error('social_links'){{ $message }}
                                        @enderror</span>
                                    <a href="javascript:void(0)" id="url_increment" style="top: 0;"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description" class="mb-2">About </label>
                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter Full Description">{{ $user->description }}</textarea>

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

                                        <span class="invalid-feedback">@error('avatar'){{ $message }}
                                            @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-2">
                                    <label for="">Uploaded Image</label>
                                </div>
                                <div id="imageContainer">
                                    <span id="closeIcon" onclick="removeImage()">&#10006;</span>
                                    @if ($user->avatar)
                                    <img src="{{asset($user->avatar)}}" alt="No Image"
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
                                                    id="flexRadioDefault1" value="1" {{ $user->recivingMessage == 1
                                                ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Enable
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault2" value="0" {{ $user->recivingMessage == 0
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

<!-- === Instructor update page @E === -->
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
let extraFields = document.querySelector('.url-extra-field');

// A function to create a new input field
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
  link.setAttribute("onclick", "removeField(this)");
  div.appendChild(node);
  div.appendChild(link);

  extraFields.appendChild(div);
}

// A function to remove a field
const removeField = (element) => {
  let fieldDiv = element.parentElement;
  fieldDiv.remove();
}

// Add an event listener to create a new field
urlBttn.addEventListener('click', createField, true);

// Show the minus icon for the existing input fields in the loop
const existingInputs = document.querySelectorAll('.url-extra-field input');
for (const input of existingInputs) {
  let link = document.createElement("a");
  link.innerHTML = "<i class='fas fa-minus'></i>";
  link.setAttribute("onclick", "removeField(this)");

  let div = document.createElement("div");
  div.appendChild(input);
  div.appendChild(link);

  extraFields.appendChild(div);
}

</script>

@endsection
{{-- page script @E --}}