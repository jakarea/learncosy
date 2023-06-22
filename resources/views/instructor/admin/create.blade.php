@extends('layouts/admin')
@section('title') Instructor Add Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Instructor add page @S === -->
<main class="profile-update-page">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-head">
                    <h6>Instructor Add</h6>
                    <a href="{{url('admin/instructor')}}">
                        <i class="fa-solid fa-user-group"></i> All Instructor </a>
                </div>
                <div class="create-form-wrap">
                    
                    <!-- Instructor Add form @S -->
                    <form action="{{route('instructor.add')}}" method="POST" class="profile-form create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <div class="form-flex">
                                        <label for="name" >Name: <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" placeholder="Enter Name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name">
                                    </div>
                                    <span class="invalid-feedback">@error('name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <div class="form-flex">
                                        <label for="username" >Subdomain: <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" placeholder="Enter Subdomain" name="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" id="username">
                                    </div>
                                    <span class="warning-txt text-end">After set the username, it's not
                                        changeable.</span>
                                    <span class="invalid-feedback">@error('username'){{ $message }}
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
                                            value="{{ old('phone') }}" id="phone">
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
                                            value="{{ old('email') }}" id="email">
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
                                            placeholder="Enter short bio">{{ old('short_bio') }}</textarea>
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
                                            <input type="text" placeholder="Enter Social Link" name="social_links[]"
                                            class="form-control w-100 @error('social_links') is-invalid @enderror"
                                            id="features" multiple value="{{ old('social_links') }}">

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
                                            placeholder="Enter Full Description">{{ old('description') }}</textarea>
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
                                        <img  src="{{asset('assets/images/avtar-place.png')}}" alt="Avatar" class="img-fluid static-image"> 
                                    
                                  </div> 
                                  <span id="uploaded-image-name"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0 mt-3">
                                   
                                    <div class="form-flex">
                                        <label for="recivingMessage">Receiving Messages: </label>
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="radio" name="recivingMessage"
                                                id="flexRadioDefault1" value="1"  checked>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Initial Password for this User : <code class="bg-danger text-white p-1">1234567890</code> </label>
                                    <sup>*Can be Change it Later</sup>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="submit-bttns"> 
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Student add form @E -->
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
<script src="{{asset('assets/js/image-upload.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
    <script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
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