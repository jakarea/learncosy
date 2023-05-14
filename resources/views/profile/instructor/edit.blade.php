@extends('layouts/instructor')
@section('title') Profile Update Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
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
                        <h6>Update Instructor Profile</h6>
                        <a href="{{url('instructors/profile/nayan-akram')}}">
                            <i class="fa-solid fa-user"></i> My Profile </a>
                    </div>
                    <!-- course create form @S -->
                    <form action="" method="POST" class="create-form-box" enctype="multipart/form-data">
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
                                                value="{{ old('name')}}" id="name">
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
                                                value="{{ old('short_bio')}}" id="short_bio">
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
                                                value="{{ old('email')}}" id="email">
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
                                                value="{{ old('phone')}}" id="phone">
                                            <span class="invalid-feedback">@error('phone'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="files">Profile Picture <sup class="text-danger">*</sup></label>
                                            <input type="file" name="thumbnail" id="files"
                                                class="form-control  @error('thumbnail') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('thumbnail'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="features">Social Media </label>
                                            <input type="text" placeholder="Enter Social Link" name="social_links[]"
                                                class="form-control @error('social_links') is-invalid @enderror"
                                                id="features" multiple>
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
                                                placeholder="Enter Short Description">{{ old('description')}}</textarea>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="hascertificate">Receiving Messages </label>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="hascertificate"
                                                        id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Enable
                                                    </label>
                                                </div>
                                                <div class="form-check ms-4">
                                                    <input class="form-check-input" type="radio" name="hascertificate"
                                                        id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Disable
                                                    </label>
                                                </div>
                                            </div>
        
                                            <span class="invalid-feedback">@error('hascertificate'){{ $message }}
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
                                    <button type="submit" class="btn btn-submit">Submit</button>
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
<script src="{{asset('assets/js/file-upload.js')}}" type="text/javascript"></script>
 


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