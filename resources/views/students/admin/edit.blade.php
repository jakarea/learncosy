@extends('layouts/instructor')
@section('title') Student Profile Edit Page @endsection

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
<main class="profile-update-page">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-head">
                    <h6>Update Profile</h6>
                    <a href="{{url('admin/students')}}">
                        <i class="fa-solid fa-user-group"></i> All Students </a>
                </div>
                <div class="create-form-wrap">
                    
                    <!-- course create form @S -->
                    <form action="{{route('admin.updateStudentProfile',$student->id)}}" method="POST" class="profile-form create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <div class="form-flex">
                                        <label for="name"  style="min-width: 10%">Name: <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" placeholder="Enter your Name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $student->name }}" id="name" style="width: 90%">
                                    </div>
                                    <span class="invalid-feedback">@error('name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <div class="form-flex">
                                        <label for="phone">Phone <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" placeholder="Enter Phone Number" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ $student->phone }}" id="phone">
                                    </div>
                                    <span class="invalid-feedback">@error('phone'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <div class="form-flex">
                                        <label for="email">Email <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="email" placeholder="Enter email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ $student->email }}" id="email" disabled>
                                    </div>
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
                                    <div class="form-flex">
                                        <label for="short_bio">Short Bio <sup class="text-danger">*</sup>
                                        </label>
                                        <textarea name="short_bio" id="short_bio"
                                            class="form-control @error('short_bio') is-invalid @enderror"
                                            placeholder="Enter short bio">{{ $student->short_bio }}</textarea>
                                    </div>
                                    <span class="invalid-feedback">@error('short_bio'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-flex  ">
                                        <label for="features" class="mb-1">Social Media: </label>

                                        <div class="w-100">
                                            @php
                                            $socialLinks = explode(",",$student->social_links);
                                            @endphp
                                            @foreach ($socialLinks as $social) 
                                            <input type="text" placeholder="Enter Social Link" name="social_links[]"
                                                class="form-control w-100 @error('social_links') is-invalid @enderror"
                                                id="features" multiple value="{{ $social }}">
                                            @endforeach 

                                            <div class="url-extra-field">
                                            </div>
                                        </div>  
                                    </div> 
                                    <span class="invalid-feedback">@error('social_links'){{ $message }}
                                        @enderror</span>
                                        <a href="javascript:void(0)" id="url_increment"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mt-3">
                                    <div class="form-flexs">
                                        <label for="description" class="mb-2">Description: </label>
                                        <textarea name="description" id="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter Full Description">{{ $student->description }}</textarea>
                                    </div>
                                    <span class="invalid-feedback">@error('description'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div id="image-container">
                                    <label for="image-input" id="upload-label">
                                      <i   class="fas fa-plus"></i>
                                    </label>
                                    <input type="file" name="avatar" id="image-input" style="display: none;">
                                    <div id="uploaded-image" style="display: none;">
                                      <img id="uploaded-image-preview" alt="Uploaded Image">
                                      
                                      <i id="close-icon" class="fas fa-times"></i>
                                    </div>
                                    @if ($student->avatar) 
                                    <img src="{{asset('assets/images/students/'.$student->avatar)}}" alt="Avatar"
                                        class="img-fluid static-image"> 
                                    @else 
                                        <img  src="{{asset('assets/images/avtar-place.png')}}" alt="Avatar" class="img-fluid static-image">
                                    @endif 
                                    
                                  </div> 
                                  <span id="uploaded-image-name"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0 mt-3">
                                   
                                    <div class="form-flex">
                                        <label for="recivingMessage">Receiving Messages: </label>
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="radio" name="recivingMessage"
                                                id="flexRadioDefault1" value="1" {{ $student->recivingMessage == 1
                                            ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Enable
                                            </label>
                                        </div>
                                        <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="recivingMessage"
                                                id="flexRadioDefault2" value="0" {{ $student->recivingMessage == 0
                                            ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Disable
                                            </label>
                                        </div>
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
                            <div class="col-md-12">
                                <div class="submit-bttns"> 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
    <script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/image-upload.js')}}"></script>
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