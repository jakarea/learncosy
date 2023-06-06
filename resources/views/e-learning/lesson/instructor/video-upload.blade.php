@extends('layouts/instructor')
@section('title') Video Upload Page @endsection

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
                        <h6>Upload Lesson Video</h6>
                        <a href="{{url('instructor/lessons')}}">
                            <i class="fa-solid fa-list"></i> All Lesson </a>
                    </div>
                    <!-- Lesson create form @S -->
                    <form action="" method="POST" class="create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="course_id">Selected Course <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="course_id" id="course_id"
                                                class="form-control @error('course_id') is-invalid @enderror" disabled>
                                                <option value="" disabled>Select Below</option>
                                                @foreach($courses as $course)
                                                <option value="{{$course->id}}">{{$course->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback">@error('course_id'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="module_id">Selected Module <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="module_id" id="module_id"
                                                class="form-control @error('module_id') is-invalid @enderror" disabled>
                                                <option value="" disabled>Select Below</option>
                                                @foreach($modules as $module)
                                                <option value="{{$module->id}}">{{$module->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback">@error('module_id'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-9 col-12">
                                        <div class="video-upload-wrap">
                                            <div class="uploadOuter">
                                                <span class="dragBox">
                                                    <i class="fas fa-plus"></i>
                                                    Darg and Drop Video here or <br> click to upload
                                                    <input type="file" onChange="dragNdrop(event)" name="video_link"
                                                        ondragover="drag()" ondrop="drop()" id="uploadFile" />
                                                </span>
                                            </div>
                                            {{-- <div id="preview"></div> --}}
                                            <div class="upload-progress">
                                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 25%"></div>
                                                  </div>
                                                  <h3>25%</h3>
                                                  <p>Please, while uploading the video. don't close the window or dont't change the URL *</p>
                                            </div>
                                        </div>
                                        <span class="invalid-feedback">@error('video_link'){{ $message }}
                                            @enderror</span>
                                    </div>

                                </div> <!-- row end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="submit-bttns">
                                    <button type="reset" class="btn btn-reset">Clear</button>
                                    <button type="submit" class="btn btn-submit">Upload</button>
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
<script>
    function dragNdrop(event) {
    var fileName = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("preview");
    var previewImg = document.createElement("img");
    previewImg.setAttribute("src", fileName);
    preview.innerHTML = "";
    preview.appendChild(previewImg);
}
function drag() {
    document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
}
function drop() {
    document.getElementById('uploadFile').parentNode.className = 'dragBox';
}
</script>
@endsection

{{-- page script @E --}}