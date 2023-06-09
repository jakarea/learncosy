@extends('layouts/instructor')
@section('title') Course Create Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
    .mt-custm{
        top: 3.4rem!important;
    } 
</style>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === course create page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-head">
                    <h6>Create a new Course</h6>
                    <a href="{{url('instructor/courses')}}">
                        <i class="fa-solid fa-list"></i> All Courses </a>
                </div>
                <div class="create-form-wrap">

                    <!-- course create form @S -->
                    <form action="{{route('course.store')}}" method="POST" class="create-form-box"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="title">Title <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter Course Title" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title')}}" id="title">
                                            <span class="invalid-feedback">@error('title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="sub_title">Sub Title
                                            </label>
                                            <input type="text" placeholder="Enter Sub Title" name="sub_title"
                                                class="form-control @error('sub_title') is-invalid @enderror"
                                                value="{{ old('sub_title')}}" id="sub_title">
                                            <span class="invalid-feedback">@error('sub_title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="features">Key Features
                                            </label>
                                            <input type="text" placeholder="Enter Features" name="features[]"
                                                class="form-control @error('features') is-invalid @enderror"
                                                id="features" multiple>
                                            <div class="url-extra-field">
                                            </div>
                                            <span class="invalid-feedback">@error('features'){{ $message }}
                                                @enderror</span>
                                            <a href="javascript:void(0)" class="mt-custm" id="url_increment"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="prerequisites">Prerequisites
                                            </label>
                                            <input type="text" placeholder="Enter Prerequisites" name="prerequisites"
                                                class="form-control @error('prerequisites') is-invalid @enderror"
                                                value="{{ old('prerequisites')}}" id="prerequisites">
                                            <span class="invalid-feedback">@error('prerequisites'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="outcome">Outcome
                                            </label>
                                            <input type="text" placeholder="Enter Outcome" name="outcome"
                                                class="form-control @error('outcome') is-invalid @enderror"
                                                value="{{ old('outcome')}}" id="outcome">
                                            <span class="invalid-feedback">@error('outcome'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-error">
                                            <label for="promo_video">Promo Video
                                            </label>
                                            <input type="url" placeholder="Enter Promo Video URL" name="promo_video"
                                                class="form-control @error('promo_video') is-invalid @enderror"
                                                value="{{ old('promo_video')}}" id="promo_video">
                                            <span class="invalid-feedback">@error('promo_video'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-error">
                                            <label for="price">Price <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter Price" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price')}}" id="price">
                                            <span class="invalid-feedback">@error('price'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-error">
                                            <label for="offer_price">Offer Price
                                            </label>
                                            <input type="text" placeholder="Enter Offer Price" name="offer_price"
                                                class="form-control @error('offer_price') is-invalid @enderror"
                                                value="{{ old('offer_price')}}" id="offer_price">
                                            <span class="invalid-feedback">@error('offer_price'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categories">Categories <sup class="text-danger">*</sup></label>
                                            <select id="categoriess" data-tags="true"
                                                class="form-select @error('categories') is-invalid @enderror"
                                                multiple="multiple" name="categories[]">
                                                <option disabled hidden>Select or Create categories</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category }}" {{ (collect(old('categories'))->
                                                    contains($category)) ? 'selected':'' }}>{{ ucfirst($category) }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-angle-down arrw-down"></i>
                                            <span class="invalid-feedback">@error('categories'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6"> 
                                        <div class="form-group mb-0">
                                            <label for="">Thumbnail</label>
                                        </div>
                                        <div id="image-container" class="mt-0">
                                            <label for="image-input" id="upload-label">
                                              <i   class="fas fa-plus"></i>
                                            </label>
                                            <input type="file" name="thumbnail" id="image-input" style="display: none;">
                                            <div id="uploaded-image" style="display: none;">
                                              <img id="uploaded-image-preview" alt="Uploaded Image">
                                              <i id="close-icon" class="fas fa-times"></i>
                                            </div> 
                                                <img  src="{{asset('assets/images/thumbnail.png')}}" alt="thumbnail" class="img-fluid static-image">
                                          </div>  
                                          <div class="text-start mt-2">
                                            <span id="uploaded-image-name"></span>
                                          </div>
                                    </div>
                                    <div class="col-lg-6"> 
                                        <div class="form-group mb-0">
                                            <label for="">Banner</label>
                                        </div>
                                        <div id="image-container2" class="mt-0">
                                            <label for="image-input2" id="upload-label2">
                                              <i  class="fas fa-plus"></i>
                                            </label>
                                            <input type="file" name="banner" id="image-input2" style="display: none;">
                                            <div id="uploaded-image2" style="display: none;">
                                              <img id="uploaded-image-preview2" alt="Uploaded Image">
                                              <i id="close-icon2" class="fas fa-times"></i>
                                            </div> 
                                                <img  src="{{asset('assets/images/thumbnail.png')}}" alt="banner" class="img-fluid static-image2">
                                          </div> 
                                          <div class="text-start mt-2">
                                            <span id="uploaded-image-name2"></span>
                                          </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group  mt-4">
                                            <label for="short_description">Short Description <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror"
                                                placeholder="Enter Short Description">{{ old('short_description')}}</textarea>
                                            <span class="invalid-feedback">@error('short_description'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Enter Long Description">{{ old('description')}}</textarea>
                                            <span class="invalid-feedback">@error('description'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                            <h5>Others </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_keyword">Meta Keyboard <sup> (to create a keyword use
                                                    'comma' or 'enter')</sup> </label>
                                            <modular-behaviour name="Keyword"
                                                src="https://cdn.jsdelivr.net/npm/bootstrap5-tags@1.4/tags.min.js" lazy>
                                                <select class="form-select @error('meta_keyword') is-invalid @enderror"
                                                    id="meta_keyword" name="meta_keyword[]" multiple
                                                    data-allow-clear="1" data-allow-new="true" data-separator="|,|">
                                                    <option disabled hidden value="">Add meta keyword</option>
                                                </select>
                                            </modular-behaviour>
                                            <span class="invalid-feedback">@error('meta_keyword'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description </label>
                                            <textarea name="meta_description" id="meta_description"
                                                class="form-control @error('meta_description') is-invalid @enderror"
                                                placeholder="Enter Meta Description">{{ old('meta_description')}}</textarea>
                                            <span class="invalid-feedback">@error('meta_description'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number_of_module">Total Module
                                            </label>
                                            <input type="number" placeholder="Enter total module length"
                                                name="number_of_module"
                                                class="form-control @error('number_of_module') is-invalid @enderror"
                                                value="{{ old('number_of_module')}}" id="number_of_module" min="0">
                                            <span class="invalid-feedback">@error('number_of_module'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number_of_lesson">Total Lesson
                                            </label>
                                            <input type="number" placeholder="Enter total lesson length"
                                                name="number_of_lesson"
                                                class="form-control @error('number_of_lesson') is-invalid @enderror"
                                                value="{{ old('number_of_lesson')}}" id="number_of_lesson" min="0">
                                            <span class="invalid-feedback">@error('number_of_lesson'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number_of_attachment">Total Attachment
                                            </label>
                                            <input type="number" placeholder="Enter total attachment length"
                                                name="number_of_attachment"
                                                class="form-control @error('number_of_attachment') is-invalid @enderror"
                                                value="{{ old('number_of_attachment')}}" id="number_of_attachment"
                                                min="0">
                                            <span class="invalid-feedback">@error('number_of_attachment'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number_of_video">Total Video
                                            </label>
                                            <input type="number" placeholder="Enter total video length"
                                                name="number_of_video"
                                                class="form-control @error('number_of_video') is-invalid @enderror"
                                                value="{{ old('number_of_video')}}" id="number_of_video" min="0">
                                            <span class="invalid-feedback">@error('number_of_video'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="duration">Total Duration
                                            </label>
                                            <input type="number" placeholder="Enter duration" name="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                value="{{ old('duration')}}" id="duration" min="0">
                                            <span class="invalid-feedback">@error('duration'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="subscription_status">Subscription Status</label>
                                            <select name="subscription_status" id="subscription_status"
                                                class="form-control @error('subscription_status') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                <option value="one_time">One Time</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="anully">Anully</option>
                                                <option value="free">Free</option>
                                            </select>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <span class="invalid-feedback">@error('subscription_status'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                            <h5>Certificate </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="hascertificate">Has Certificate <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="hascertificate"
                                                        id="flexRadioDefault1" value="yes">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check ms-5">
                                                    <input class="form-check-input" type="radio" name="hascertificate"
                                                        id="flexRadioDefault2" checked value="no">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        No
                                                    </label>
                                                </div>
                                            </div> 
                                            <span class="invalid-feedback">@error('hascertificate'){{ $message }}
                                                @enderror</span> 
                                        </div>
                                    </div>  
                                    <div class="col-lg-6"> 
                                        <div class="form-group mb-0">
                                            <label for="">Sample Certificates</label>
                                        </div>
                                        <div id="image-container3" class="mt-0">
                                            <label for="image-input3" id="upload-label3">
                                              <i  class="fas fa-plus"></i>
                                            </label>
                                            <input type="file" name="sample_certificates" id="image-input3" style="display: none;">
                                            <div id="uploaded-image3" style="display: none;">
                                              <img id="uploaded-image-preview3" alt="Uploaded Image">
                                              <i id="close-icon3" class="fas fa-times"></i>
                                            </div> 
                                                <img  src="{{asset('assets/images/thumbnail.png')}}" alt="sample_certificates" class="img-fluid static-image3">
                                          </div> 
                                          <div class="text-start mt-3">
                                            <span id="uploaded-image-name3"></span>
                                          </div>
                                    </div> 
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                <option value="draft">Draft</option>
                                                <option value="pending">Pending</option>
                                                <option value="published">Published</option>
                                            </select>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <span class="invalid-feedback">@error('status'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>

                                </div> <!-- row end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="submit-bttns">
                                    <button type="reset" class="btn btn-reset">Reset</button>
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
<!-- === course create page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/modular-behaviour.js@3.1/modular-behaviour.js" type="module"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/tag-handler.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/image-upload.js')}}"></script>
<script src="{{asset('assets/js/image-upload-2.js')}}"></script>
<script src="{{asset('assets/js/image-upload-3.js')}}"></script>

<script>
    $('#categoriess').select2();
</script>

<script>
    const urlBttn = document.querySelector('#url_increment');
    let extraFileds = document.querySelector('.url-extra-field'); 
  
    const createFiled = () => { 
      let div = document.createElement("div");
      let node = document.createElement("input"); 
      node.setAttribute("class", "form-control @error('features') is-invalid @enderror");
      node.setAttribute("multiple", ""); 
      node.setAttribute("type", "text"); 
      node.setAttribute("placeholder", "Enter Features"); 
      node.setAttribute("name", "features[]");    
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