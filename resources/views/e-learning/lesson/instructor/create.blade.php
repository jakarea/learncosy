@extends('layouts/instructor')
@section('title') Lesson Create Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
@php 
  $course_id = isset($_GET['course']) ? $_GET['course'] : '';
  $module_id = isset($_GET['module']) ? $_GET['module'] : '';
@endphp
<!-- === Lesson create page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-head">
                    <h6>Create a new Lesson</h6>
                    <a href="{{url('instructor/lessons')}}">
                        <i class="fa-solid fa-list"></i> All Lesson </a>
                </div>
                <div class="create-form-wrap">
                    
                    <!-- Lesson create form @S -->
                    <form action="{{route('lesson.store')}}" method="POST" class="create-form-box" enctype="multipart/form-data">
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
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}" {{ $course->id == $course_id ? 'selected' : ''}}>{{$course->title}}</option>
                                                @endforeach
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
                                                @foreach($modules as $module)
                                                    <option value="{{$module->id}}"  {{ $module->id == $module_id ? 'selected' : ''}}>{{$module->title}}</option>
                                                @endforeach
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
                                            <label for="">File</label>
                                        </div>
                                        <div id="image-container2" class="mt-0">
                                            <label for="image-input2" id="upload-label2">
                                              <i  class="fas fa-plus"></i>
                                            </label>
                                            <input type="file" name="lesson_file" id="image-input2" style="display: none;">
                                            <div id="uploaded-image2" style="display: none;">
                                              <img id="uploaded-image-preview2" alt="Uploaded Image">
                                              <i id="close-icon2" class="fas fa-times"></i>
                                            </div> 
                                                <img  src="{{asset('assets/images/thumbnail.png')}}" alt="lesson_file" class="img-fluid static-image2">
                                          </div> 
                                          <div class="text-start mt-2">
                                            <span id="uploaded-image-name2"></span>
                                          </div>
                                    </div>
                                     
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <label for="short_description">Short Description  </label>
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
                                            <label for="meta_keyword">Meta Keyboard </label>
                                            <modular-behaviour name="Keyword"
                                                src="https://cdn.jsdelivr.net/npm/bootstrap5-tags@1.4/tags.min.js" lazy>
                                                <select class="form-select @error('meta_keyword') is-invalid @enderror"
                                                    id="meta_keyword" name="meta_keyword[]" multiple
                                                    data-allow-clear="1" data-allow-new="true" data-separator="|,|">
                                                    <option selected="selected" disabled hidden value="">Add meta keyword</option>
                                                </select>
                                            </modular-behaviour>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <span class="invalid-feedback">@error('meta_keyword'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description  </label>
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
<script src="{{asset('assets/js/tag-handler.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/image-upload.js')}}"></script>
<script src="{{asset('assets/js/image-upload-2.js')}}"></script>
@endsection

{{-- page script @E --}}