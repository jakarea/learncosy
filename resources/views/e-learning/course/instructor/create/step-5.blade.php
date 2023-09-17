@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 5
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="course-create-step-page-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-4 col-xl-3">
                {{-- course step --}}
                {{-- add class "active" to "step-box" for the done step and add a checkmark image icon inside "circle"
                class --}}
                {{-- add class "current" to "step-box" for the current step --}}
                <div class="course-create-step-wrap page-create-step">
                    <div class="step-box current">
                        <span class="circle">
                            {{-- <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                                class="img-fluid"> --}}
                        </span>
                        <p>Content</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Institutions</p>
                    </div>
                </div>
                {{-- course step --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                
                <div class="lesson-edit-form-wrap mt-4">
                    <form  id="uploadForm" action="{{ url('instructor/courses/create/step-5') }}" method="POST" class="create-form-box custom-select" enctype="multipart/form-data">
                    @csrf    
                        <div class="highlighted-area-upload dragBox">
                            <img src="{{asset('latest/assets/images/icons/big-video.svg')}}" alt="a" class="img-fluid">
                            <input type="file" onChange="dragNdrop(event)" name="video_link" ondragover="drag()" ondrop="drop()" id="uploadFile" />
                            
                            <p class="file-name"><label for="uploadFile">Click here</label> to set the highlighted video</p>
                        </div>
                        <div id="preview"></div>
                        <div class="upload-progress">
                            <div class="progress" role="progressbar" aria-label="Basic example"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 0%"></div>
                            </div>
                            <h3>0%</h3>
                            <p>Please, while uploading the video. don't close the window or dont't
                                change the URL *</p>
                            <span class="invalid-feedback">@error('video_link'){{ $message }}
                                        @enderror</span>
                        </div>

                        <h4>A Short description for this video</h4>
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <!-- <div class="form-group form-upload">
                            <label for="file" class="txt">Upload Files</label>
                            <input type="file" id="file" class="d-none">
                            <label for="file" id="upload-box">
                                <img src="{{asset('latest/assets/images/icons/upload.svg')}}" alt="Bar" class="img-fluid"> Upload
                            </label>
                            <span>*.doc, *.pdf, *.xls file (max 25 mb)</span>
                        </div> -->
    
                    {{-- course page file box start --}}
                    <!-- <div class="course-content-box course-page-edit-box">
                        <div class="title"> 
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar" class="img-fluid">
                                <div class="media-body">
                                    <h5>user-journey-01.doc</h5>
                                    <p>2m ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span>809KB</span>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Remove file</a></li>
                                <li><a class="dropdown-item" href="#">Replace file</a></li>
                            </ul>
                        </div>
                    </div> -->
                    {{-- course page file box end --}}
                    {{-- course page file box start --}}
                    <!-- <div class="course-content-box course-page-edit-box">
                        <div class="title"> 
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar" class="img-fluid">
                                <div class="media-body">
                                    <h5>user-journey-01.doc</h5>
                                    <p>2m ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span>809KB</span>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Remove file</a></li>
                                <li><a class="dropdown-item" href="#">Replace file</a></li>
                            </ul>
                        </div>
                    </div> -->
                    {{-- course page file box end --}}{{-- course page file box start --}}
                    <!-- <div class="course-content-box course-page-edit-box">
                        <div class="title">
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar" class="img-fluid">
                                <div class="media-body">
                                    <h5>user-journey-01.doc</h5>
                                    <p>2m ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span>809KB</span>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Remove file</a></li>
                                <li><a class="dropdown-item" href="#">Replace file</a></li>
                            </ul>
                        </div>
                    </div> -->
                    {{-- course page file box end --}}
                    
                </div>

                {{-- step next bttns --}}
                <div class="back-next-bttns">
                    <a href="#">Back</a>
                    <button class="btn btn-primary" type="submit">Next</button>
                </div>
                {{-- step next bttns --}}
            </form>
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
<script src="//cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js" type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>

<script>
    var baseUrl = "{{ url('') }}";
    function dragNdrop(event) {
        // While selecting file, only allow video file
        var fileInput = document.getElementById('uploadFile');
        
        var filePath = fileInput.value;
        var allowedExtensions = /(\.mp4|\.mov|\.avi|\.wmv|\.flv|\.mkv)$/i;
        if (filePath && !allowedExtensions.exec(filePath)) {
            alert('Invalid file type');
            fileInput.value = '';
            return false;
        }

    var fileName = event.target.files[0].name;
    document.querySelector('.file-name').innerHTML = fileName;
    document.querySelector('.file-name').style.display = 'block';
    document.querySelector('.file-name').style.border = '1px solid #ccc';
    document.querySelector('.file-name').style.padding = '10px';
    document.querySelector('.file-name').style.borderRadius = '5px';
    document.querySelector('.file-name').style.marginTop = '10px';
    document.querySelector('.dragBox').firstElementChild.className = 'fas fa-times';
}
function drag() {
    document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
}
function drop() {
    document.getElementById('uploadFile').parentNode.className = 'dragBox';
}

$(document).ready(function() {
    $('#uploadForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var urlParams = new URLSearchParams(window.location.search);
        console.log({formData})
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                // Upload progress
                xhr.upload.addEventListener('progress', function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $('.progress-bar').css('width', percentComplete + '%');
                        $('.upload-progress h3').text(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            beforeSend: function() {
                // set button state to loading and disable with spinner
                $('.btn-submit').attr('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...'
                );
                // check if file is not empty
                var fileInput = document.getElementById('uploadFile');
                var filePath = fileInput.value;
                if (filePath === '') {
                    alert('Please select a file');
                    $('.btn-submit').attr('disabled', false).text('Upload');
                    return false;
                }

                // upload-progress p tag add style as warning
                $('.upload-progress p').css('color', '#fff');
                // $('.upload-progress p').css('background-color', '#ffc107');
                $('.upload-progress p').css('background-color', '#ff0000');
                $('.upload-progress p').css('padding', '10px');
                $('.upload-progress p').css('border-radius', '5px');
                $('.upload-progress p').css('margin-top', '10px');
            },
            success: function(response) {
                console.log({response})
                // reset button state
                $('.btn-submit').attr('disabled', false).text('Upload');
                var uri = response.uri;
                var price = response.price;
                if(price === 0){
                    window.location.href = baseUrl + '/instructor/courses/create/step-7';
                }
                //checkProgress(uri);
            },
            // handle all types of errors
            error: function(xhr) {
                var errors = xhr.responseJSON.errors || xhr.responseJSON.message;
                alert(errors);
                console.log({errors});
                // reset button state
                $('.btn-submit').attr('disabled', false).text('Upload');
            }
        });
    });

    function checkProgress(uri) {
        var interval = setInterval(function() {
            $.ajax({
                url: '/instructor/lessons/progress',
                type: 'GET',
                data: { uri: uri },
                dataType: 'json',
                success: function(response) {
                    var progress = response.progress;
                    $('.progress-bar').css('width', progress + '%');
                    $('.upload-progress h3').text(progress + '%');
                    if (progress === 100) {
                        clearInterval(interval);
                        // redirect to lesson page
                        setTimeout(function() {
                            window.location.href = '/instructor/courses';
                            // redirect to course single page
                            // var urlParams = new URLSearchParams(window.location.search);
                            // var lesson_slug = urlParams.get('lesson_slug');
                            // window.location.href = ' route('course.show', ':lesson_slug') '.replace(
                            //     ':lesson_slug', lesson_slug);

                        }, 3000);
                    }
                },
                error: function(error) {
                    // get all errors and display
                    var errors = error.responseJSON.errors;
                    // alert(errors);
                    alert('Something went wrong. Please try again.');
                }
            });
        }, 1000);
    }
});

</script>
@endsection