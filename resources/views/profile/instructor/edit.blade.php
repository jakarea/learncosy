@extends('layouts/instructor')
@section('title') Profile Update Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Instructor update page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Update Profile</h6>
                        <a href="{{url('profile/myprofile')}}">
                            <i class="fa-solid fa-user"></i> My Profile </a>
                    </div>
                    <!-- course create form @S -->
                    <form action="{{ route('updateMyProfile',$user->id) }}" method="POST" class="create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
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
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="short_bio">Short Bio <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter short bio" name="short_bio"
                                                class="form-control @error('short_bio') is-invalid @enderror"
                                                value="{{ $user->short_bio }}" id="short_bio">
                                            <span class="invalid-feedback">@error('short_bio'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="email">Email <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="email" placeholder="Enter email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ $user->email }}" id="email">
                                            <span class="invalid-feedback">@error('email'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="files">Profile Picture <sup class="text-danger">*</sup></label>
                                            <input type="file" name="avatar" id="files"
                                                class="form-control  @error('avatar') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('avatar'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="features">Social Media </label>
                                            <input type="text" placeholder="Enter Social Link" name="social_links[]"
                                                class="form-control @error('social_links') is-invalid @enderror"
                                                id="features" multiple value="{{ $user->social_links }}">
                                            <div class="url-extra-field">
                                            </div>
                                            <span class="invalid-feedback">@error('social_links'){{ $message }}
                                                @enderror</span>
                                            <a href="javascript:void(0)" id="url_increment"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description </label>
                                            <textarea name="description" id="description"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Enter Short Description">{{ $user->description }}</textarea>
                                            <span class="invalid-feedback">@error('description'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="imgThumbnailPreview"></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="file-wrapper" @if($user->avatar) style="background-image:
                                            url({{asset('assets/images/user/'.$user->avatar)}})" @endif>
                                            <input type="file" name="avatar" accept="image/*" />
                                            <div class="close-btn"><i class="fas fa-close"></i></div>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recivingMessage">Receiving Messages </label>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="recivingMessage"
                                                        id="flexRadioDefault1" value="1" {{ $user->recivingMessage == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Enable
                                                    </label>
                                                </div>
                                                <div class="form-check ms-4">
                                                    <input class="form-check-input" type="radio" name="recivingMessage"
                                                        id="flexRadioDefault2" value="0" {{ $user->recivingMessage == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Disable
                                                    </label>
                                                </div>
                                            </div> 
                                            <span class="invalid-feedback">@error('recivingMessage'){{ $message }}
                                                @enderror</span> 
                                        </div>
                                    </div> 

                                </div> <!-- row end -->
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="submit-bttns">
                                    <button type="reset" class="btn btn-reset">Clear</button>
                                    <button type="submit" class="btn btn-submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- course create form @E -->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $('input[name="thumbnail"]').on('change', function(){
  readURL(this, $('.file-wrapper'));   
});

$('.close-btn').on('click', function(){  
   let file = $('input[name="thumbnail"]');
   $('.file-wrapper').css('background-image', 'unset');
   $('.file-wrapper').removeClass('file-set');
   file.replaceWith( file = file.clone( true ) );
});

//FILE
function readURL(input, obj){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      obj.css('background-image', 'url('+e.target.result+')');
      obj.addClass('file-set');
    }
    reader.readAsDataURL(input.files[0]);
  }
};

<script>
    const urlBttn = document.querySelector('#url_increment');
    let extraFileds = document.querySelector('.url-extra-field'); 
  
    const createFiled = () => { 
      let div = document.createElement("div");
      let node = document.createElement("input"); 
      node.setAttribute("class", "form-control @error('social_links') is-invalid @enderror");
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