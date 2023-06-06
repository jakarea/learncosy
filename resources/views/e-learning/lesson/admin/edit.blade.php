@extends('layouts/instructor')
@section('title') {{$lesson->title}} Edit Page @endsection

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
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Update Lesson</h6>
                        <a href="{{url('admin/lessons')}}">
                            <i class="fa-solid fa-list"></i> All Lesson </a>
                    </div>
                    <!-- Lesson create form @S -->
                    <form action="{{route('admin.lesson.update',$lesson->slug)}}" method="POST" class="create-form-box" enctype="multipart/form-data">
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
                                                    <option value="{{$module->id}}" {{ $module->id == $module_id ? 'selected' : ''}}>{{$module->title}}</option>
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
                                                value="{{ $lesson->title }}" id="title">
                                            <span class="invalid-feedback">@error('title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="video_link">Video URL <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="url" placeholder="Enter Video URL" name="video_link"
                                                class="form-control @error('video_link') is-invalid @enderror"
                                                value="{{ $lesson->video_link }}" id="video_link">
                                            <span class="invalid-feedback">@error('video_link'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>   --}}
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
                                            @if ($lesson->thumbnail) 
                                            <img src="{{asset('assets/images/lessons/'.$lesson->thumbnail)}}" alt="a" class="img-fluid">
                                            @else 
                                            <img src="{{asset('assets/images/thumbnail.png')}}" alt="a" class="img-fluid">
                                            @endif
                                        </div>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload-2">File  </label>
                                            <input type="file" name="lesson_file" id="file-upload-2"
                                                class="form-control  @error('lesson_file') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('lesson_file'){{ $message }}
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
                                        <label for="file-upload">Current File: </label>
                                        <div class="file-prev"> 
                                            @if ($lesson->lesson_file) 
                                            <img src="{{asset('assets/images/lessons/'.$lesson->lesson_file)}}" alt="a" class="img-fluid">
                                            @else 
                                            <img src="{{asset('assets/images/thumbnail.png')}}" alt="a" class="img-fluid">
                                            @endif
                                        </div>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                     
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description  </label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror"
                                                placeholder="Enter Short Description">{{ $lesson->short_description }}</textarea>
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
                                            @php 
                                                $selectedMetaKey = explode(",",$lesson->meta_keyword); 
                                            @endphp
                                            <label for="meta_keyword">Meta Keyboard  </label>
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
                                            <label for="meta_description">Meta Description  </label>
                                            <textarea name="meta_description" id="meta_description"
                                                class="form-control @error('meta_description') is-invalid @enderror"
                                                placeholder="Enter Meta Description">{{ $lesson->meta_description }}</textarea>
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
                                                <option value="draft" {{ $lesson->status == 'draft' ? 'selected' : ''}}>Draft</option>
                                                <option value="pending" {{ $lesson->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                                <option value="published" {{ $lesson->status == 'published' ? 'selected' : ''}}>Published</option>
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
<script src="{{asset('assets/js/file-upload.js')}}" type="text/javascript"></script>
@endsection

{{-- page script @E --}}