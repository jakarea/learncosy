@extends('layouts/admin')
@section('title') Lesson Create Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Lesson create page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Create a new Lesson</h6>
                        <a href="{{url('lesson')}}">
                            <i class="fa-solid fa-list"></i> All Lesson </a>
                    </div>
                    <!-- Lesson create form @S -->
                    <form action="" method="POST" class="create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="course_id">Select Course <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                <option value="1">Course One</option>
                                                <option value="2">Course Two</option>
                                                <option value="3">Course Three</option>
                                            </select> 
                                            <span class="invalid-feedback">@error('course_id'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="module_id">Select Module <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="module_id" id="module_id" class="form-control @error('module_id') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                <option value="1">Module One</option>
                                                <option value="2">Module Two</option>
                                                <option value="3">Module Three</option>
                                            </select> 
                                            <span class="invalid-feedback">@error('module_id'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 
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
                                            <label for="video_link">Video URL <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="url" placeholder="Enter Video URL" name="video_link"
                                                class="form-control @error('video_link') is-invalid @enderror"
                                                value="{{ old('video_link')}}" id="video_link">
                                            <span class="invalid-feedback">@error('video_link'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="files">Thumbnail <sup class="text-danger">*</sup></label>
                                            <input type="file" name="thumbnail" id="files"
                                                class="form-control  @error('thumbnail') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('thumbnail'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="imgThumbnailPreview"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File <sup class="text-danger">*</sup></label>
                                            <input type="file" name="file" id="file"
                                                class="form-control  @error('file') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('file'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="imgCoverimagePreview"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror"
                                                placeholder="Enter Short Description">{{ old('short_description')}}</textarea>
                                            <span class="invalid-feedback">@error('short_description'){{ $message }}
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
                                            <label for="meta_keyword">Meta Keyboard <sup
                                                    class="text-danger">*</sup></label>
                                            <modular-behaviour name="Keyword"
                                                src="https://cdn.jsdelivr.net/npm/bootstrap5-tags@1.4/tags.min.js" lazy>
                                                <select class="form-select @error('meta_keyword') is-invalid @enderror"
                                                    id="meta_keyword" name="meta_keyword[]" multiple
                                                    data-allow-clear="1" data-allow-new="true" data-separator="|,|">
                                                    <option selected="selected" disabled hidden value="">Create meta keyword...</option>
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
                                                placeholder="Enter Meta Description">{{ old('meta_description')}}</textarea>
                                            <span class="invalid-feedback">@error('meta_description'){{ $message }}
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
                                    <button type="reset" class="btn btn-reset">Clear</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Lesson create form @E -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- === Lesson create page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://cdn.jsdelivr.net/npm/modular-behaviour.js@3.1/modular-behaviour.js" type="module"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/tag-handler.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/file-upload.js')}}" type="text/javascript"></script>
 


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