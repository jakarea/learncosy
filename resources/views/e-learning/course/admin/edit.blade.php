@extends('layouts/instructor')
@section('title') {{$course->title}} Edit Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === course create page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Update Course</h6>
                        <a href="{{url('admin/courses')}}">
                            <i class="fa-solid fa-list"></i> All Courses </a>
                    </div>
                    <!-- course create form @S -->
                    <form action="{{route('admin.course.update',$course->slug)}}" method="POST" class="create-form-box"
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
                                                value="{{ $course->title }}" id="title">
                                            <span class="invalid-feedback">@error('title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="sub_title">Sub Title <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter Sub Title" name="sub_title"
                                                class="form-control @error('sub_title') is-invalid @enderror"
                                                value="{{ $course->sub_title }}" id="sub_title">
                                            <span class="invalid-feedback">@error('sub_title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="features">Key Features
                                            </label>
                                            @php 
                                                $selectedFeatures = explode(",",$course->features); 
                                            @endphp 
                                            @foreach($selectedFeatures as $key => $feature)
                                                <input type="text" placeholder="Enter Features" name="features[]"
                                                class="form-control @error('features') is-invalid @enderror"
                                                id="features" value="{{$feature}}" multiple>
                                            @endforeach
                                            <div class="url-extra-field">
                                            </div>
                                            <span class="invalid-feedback">@error('features'){{ $message }}
                                                @enderror</span>
                                            <a href="javascript:void(0)" id="url_increment"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="prerequisites">Prerequisites  
                                            </label>
                                            <input type="text" placeholder="Enter Prerequisites" name="prerequisites"
                                                class="form-control @error('prerequisites') is-invalid @enderror"
                                                value="{{ $course->prerequisites }}" id="prerequisites">
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
                                                value="{{ $course->outcome }}" id="outcome">
                                            <span class="invalid-feedback">@error('outcome'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-error">
                                            <label for="promo_video">Promo Video  
                                            </label>
                                            <input type="text" placeholder="Enter Promo Video URL" name="promo_video"
                                                class="form-control @error('promo_video') is-invalid @enderror"
                                                value="{{ $course->promo_video }}" id="promo_video">
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
                                                value="{{ $course->price }}" id="price">
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
                                                value="{{ $course->offer_price }}" id="offer_price">
                                            <span class="invalid-feedback">@error('offer_price'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <label for="categories">Categories </label> 
                                            <select id="categoriess" data-tags="true" class="form-select @error('categories') is-invalid @enderror" multiple="multiple" name="categories[]">
                                                <option disabled hidden>Select or Create categories</option> 
                                                @foreach ($categories as $category)
                                                    <option value="{{$category}}" {{ in_array($category,$categories) ? "selected" : ''}} >
                                                        {{ ucfirst($category) }}</option> 
                                                @endforeach 
                                              </select>
                                              <i class="fas fa-angle-down arrw-down"></i>
                                              <span class="invalid-feedback">@error('categories'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload">Thumbnail <sup class="text-danger">*</sup></label>
                                            <input type="file" name="thumbnail" id="file-upload"
                                                class="form-control  @error('thumbnail') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('thumbnail'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews"></div>
                                            <button type="button" class="btn" id="close-button"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-4">
                                        {{-- img preview @S --}}
                                        <div class="form-group">
                                        <label for="file-upload">Current Thumbnail: </label>
                                        <div class="file-prev">
                                            @if ($course->thumbnail)
                                            <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="a" class="img-fluid">
                                            @else 
                                            <img src="{{asset('assets/images/thumbnail.png')}}" alt="a" class="img-fluid">
                                            @endif
                                             
                                        </div>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload-2">Banner  </label>
                                            <input type="file" name="banner" id="file-upload-2"
                                                class="form-control  @error('banner') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('banner'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews-2"></div>
                                            <button type="button" class="btn" id="close-button-2"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-4">
                                        {{-- img preview @S --}}
                                        <div class="form-group">
                                        <label for="file-upload">Current Banner: </label>
                                        <div class="file-prev">
                                            @if ($course->banner) 
                                            <img src="{{asset('assets/images/courses/'.$course->banner)}}" alt="a" class="img-fluid">
                                            @else 
                                            <img src="{{asset('assets/images/thumbnail.png')}}" alt="a" class="img-fluid">
                                            @endif
                                             
                                        </div>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror"
                                                placeholder="Enter Short Description">{{ $course->short_description }}</textarea>
                                            <span class="invalid-feedback">@error('short_description'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Enter Long Description">{{ $course->description }}</textarea>
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
                                            @php 
                                                $selectedMetaKey = explode(",",$course->meta_keyword); 
                                            @endphp
                                            <label for="meta_keyword">Meta Keyboard <sup class="text-danger">*</sup></label>
                                            <modular-behaviour name="Keyword"
                                                src="https://cdn.jsdelivr.net/npm/bootstrap5-tags@1.4/tags.min.js" lazy>
                                                <select class="form-select @error('meta_keyword') is-invalid @enderror"
                                                    id="meta_keyword" name="meta_keyword[]" multiple
                                                    data-allow-clear="1" data-allow-new="true" data-separator="|,|">
                                                    <option selected="selected" disabled hidden value="">Add meta keyword</option>

                                                    @foreach($selectedMetaKey as $key => $metakey)
                                                        <option value="{{$metakey}}" {{ in_array($metakey,$selectedMetaKey) ? "selected" : ''}} >{{$metakey}}</option> 
                                                    @endforeach

                                                </select>
                                            </modular-behaviour>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <span class="invalid-feedback">@error('meta_keyword'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea name="meta_description" id="meta_description"
                                                class="form-control @error('meta_description') is-invalid @enderror"
                                                placeholder="Enter Meta Description">{{ $course->meta_description }}</textarea>
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
                                                value="{{ $course->number_of_module }}" id="number_of_module">
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
                                                value="{{ $course->number_of_lesson }}" id="number_of_lesson">
                                            <span class="invalid-feedback">@error('number_of_lesson'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number_of_quiz">Total Quiz
                                            </label>
                                            <input type="number" placeholder="Enter total quiz length"
                                                name="number_of_quiz"
                                                class="form-control @error('number_of_quiz') is-invalid @enderror"
                                                value="{{ $course->number_of_quiz }}" id="number_of_quiz">
                                            <span class="invalid-feedback">@error('number_of_quiz'){{ $message }}
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
                                                value="{{ $course->number_of_attachment }}" id="number_of_attachment">
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
                                                value="{{ $course->number_of_video }}" id="number_of_video">
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
                                                value="{{ $course->duration }}" id="duration">
                                            <span class="invalid-feedback">@error('duration'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                            <h5>Certificate </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="hascertificate">Has Certificate </label>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="hascertificate"
                                                        id="flexRadioDefault1" value="yes" {{ $course->hascertificate == 'yes' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check ms-4">
                                                    <input class="form-check-input" type="radio" name="hascertificate"
                                                        id="flexRadioDefault2" value="no" {{ $course->hascertificate == 'no' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        No
                                                    </label>
                                                </div>
                                            </div>

                                            <span class="invalid-feedback">@error('hascertificate'){{ $message }}
                                                @enderror</span>

                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="file-upload-3">Sample Certificates </label>
                                            <input type="file" name="sample_certificates" id="file-upload-3"
                                                class="form-control  @error('sample_certificates') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('sample_certificates'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews-3"></div>
                                            <button type="button" class="btn" id="close-button-3"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-3">
                                        {{-- img preview @S --}}
                                        <div class="form-group">
                                        <label for="file-upload">Current Certificates: </label>
                                        <div class="file-prev">
                                            @if ($course->sample_certificates) 
                                            <img src="{{asset('assets/images/courses/'.$course->sample_certificates)}}" alt="a" class="img-fluid">
                                            @else 
                                            <img src="{{asset('assets/images/thumbnail.png')}}" alt="a" class="img-fluid">
                                            @endif
                                             
                                        </div>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="subscription_status">Subscription Status</label>
                                            <select name="subscription_status" id="subscription_status"
                                                class="form-control @error('subscription_status') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                <option value="one_time" {{ $course->subscription_status == 'one_time' ? 'selected' : ''}}>One Time</option>
                                                <option value="monthly" {{ $course->subscription_status == 'monthly' ? 'selected' : ''}}>Monthly</option>
                                                <option value="anully" {{ $course->subscription_status == 'anully' ? 'selected' : ''}}>Anully</option>
                                                <option value="free" {{ $course->subscription_status == 'free' ? 'selected' : ''}}>Free</option>
                                            </select>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <span class="invalid-feedback">@error('subscription_status'){{ $message }}
                                                @enderror</span>
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
                                                <option value="draft" {{ $course->status == 'draft' ? 'selected' : ''}}>Draft</option>
                                                <option value="pending" {{ $course->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                                <option value="published" {{ $course->status == 'published' ? 'selected' : ''}}>Published</option>
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
<script src="{{asset('assets/js/file-upload.js')}}" type="text/javascript"></script>

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