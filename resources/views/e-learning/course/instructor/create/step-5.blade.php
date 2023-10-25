@extends('layouts.latest.instructor')
@section('title')
Course Create - Video Upload Step
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="course-create-step-page-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-4 col-xl-3">
                {{-- course step --}}
                <div class="course-create-step-wrap page-create-step">
                    <div class="step-box current">
                        <span class="circle"> 
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
                <div class="row">
                    {{-- main video upload area start --}}
                    <div class="col-lg-12">
                        <div class="highlighted-area-upload text-center">
                            <img src="{{asset('latest/assets/images/icons/big-video.svg')}}" alt="a" class="img-fluid">

                            <p style="font-size: 1rem"><label for="uploadFile">Click here</label> to upload full course
                                video</p>
                        </div>
                    </div>
                    {{-- main video upload area end --}} 
                </div>
                <form id="uploadForm" action="" method="POST" class="create-form-box custom-select"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="lesson-edit-form-wrap mt-4">
                        <input type="file" onChange="dragNdrop(event)" name="video_link" ondragover="drag()"
                            ondrop="drop()" id="uploadFile" class="d-none" />
                        <input type="hidden" name="duration" id="duration" />

                        <div id="preview" class="mt-2"></div>
                        <div class="upload-progress">
                            <div class="progress d-none">
                                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 0%"></div>
                            </div>
                            <h3 class="h33 d-none">0%</h3>
                            <p class="warnm d-none">Please, while uploading the video. don't close the window or dont't
                                change the URL *</p>
                            <span class="invalid-feedback">
                                @error('video_link')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <h4>A Short description for this video</h4>
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>

                        <div class="form-group form-upload">
                            <label for="file-input" class="txt">Upload Files</label>
                            <input type="file" id="file-input" class="opacity-0" name="lesson_file[]" multiple>
                            <label for="file-input" id="upload-box">
                                <img src="{{asset('latest/assets/images/icons/upload.svg')}}" alt="Bar"
                                    class="img-fluid"> Upload
                            </label>
                            <span>*.doc, *.pdf, *.xls file (max 25 mb)</span>
                        </div>

                        {{-- course page file box start --}}
                        <div id="file-list">
                            <!-- Uploaded files will be displayed here -->
                        </div>

                        @php
                        $lessonFileString = $lesson->lesson_file;
                        $uploadedFilenames = explode(',', $lessonFileString);
                        @endphp
                        @if ($lesson->lesson_file)
                        <div class="form-group form-upload">
                            <label for="file-input" class="txt">Uploaded Files</label>
                        </div>
                        @foreach ($uploadedFilenames as $filename)
                        <div class="course-content-box course-page-edit-box">
                            <div class="title">
                                <div class="media">
                                    <img src="{{ asset('latest/assets/images/icons/file.svg') }}" alt="File"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>{{ $filename }} </h5>
                                        <p>{{ $lesson->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif 
                        
                        {{-- course page file box end --}}

                    </div>
                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="{{ url('instructor/courses/create/'.$lesson->course_id) }}">Back</a>
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
<script src="//cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{ asset('latest/assets/js/tinymce.js') }}" type="text/javascript"></script>

{{-- file upload preview --}}
<script>
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');

    fileInput.addEventListener('change', function () {
        const files = Array.from(fileInput.files);

        files.forEach(file => {
            if (!isValidFile(file)) {
                alert('Invalid file format or size: ' + file.name);
                return;
            }

            const listItem = document.createElement('div');
            listItem.classList.add('course-content-box', 'course-page-edit-box');

            listItem.innerHTML = `
                <div class="title">
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/file.svg') }}" alt="File" class="img-fluid">
                        <div class="media-body">
                            <h5>${file.name}</h5>
                            <p>Uploaded: ${new Date().toLocaleString()}</p>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <span>${formatBytes(file.size)}</span>
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item remove-file-button" href="javascript:void(0)">Remove file</a></li> 
                    </ul>
                </div>
            `;

            fileList.appendChild(listItem);
        });
    });

    // Add an event listener for the "Remove file" button
    fileList.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-file-button')) {
            const listItem = event.target.closest('.course-content-box');
            const fileName = listItem.querySelector('h5').textContent;
            
            // Remove the file from the list
            listItem.remove();
            
            // Remove the file from the input path
            removeFileFromInput(fileInput, fileName);
        }
    });

    function isValidFile(file) {
        const allowedExtensions = ['.doc', '.pdf', '.xls'];
        const maxFileSize = 25 * 1024 * 1024; // 25 MB

        const fileExtension = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes('.' + fileExtension)) {
            return false;
        }

        if (file.size > maxFileSize) {
            return false;
        }

        return true;
    }

    function removeFileFromInput(fileInput, fileName) {
        const files = Array.from(fileInput.files);
        const index = files.findIndex(file => file.name === fileName);

        if (index !== -1) {
            files.splice(index, 1);
            fileInput.files = new FileList({ items: files });
        }
    }

    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>

<script>
    var baseUrl = "{{ url('') }}";
        var currentURL = window.location.href
        var urlObject = new URL(currentURL);
        var pathname = urlObject.pathname;
        var pathnameParts = pathname.split('/');
        var course_id = pathnameParts[4];
        var module_id = pathnameParts[6];
        const uploadProgress = document.querySelector('.progress');
        const warnm = document.querySelector('.warnm');
        const h33 = document.querySelector('.h33');

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
                uploadProgress.classList.remove('d-none');
                warnm.classList.remove('d-none');
                h33.classList.remove('d-none');
                var formData = new FormData(this);
                var urlParams = new URLSearchParams(window.location.search);
                var url = window.location.href;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    // xhr: function() {
                    //     var xhr = new window.XMLHttpRequest();
                    //     // Upload progress
                    //     xhr.upload.addEventListener('progress', function(evt) {
                    //         if (evt.lengthComputable) {
                    //             var percentComplete = (evt.loaded / evt.total) * 100;
                    //             $('.progress-bar').css('width', percentComplete + '%');
                    //             $('.upload-progress h3').text(percentComplete + '%');
                    //         }
                    //     }, false);
                    //     return xhr;
                    // },
                    beforeSend: function() {

                        // set button state to loading and disable with spinner
                        $('.btn-submit').attr('disabled', true).html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...'
                        );
                        // check if file is not empty

                        var fileInput = document.getElementById('uploadFile');
                        const selectedFile = fileInput.files[0];

                        // Get the size of the selected file in bytes
                        const fileSizeBytes = selectedFile.size;

                        // Convert the size to a more human-readable format (e.g., KB, MB, GB)
                        const fileSizeKB = fileSizeBytes / 1024; // 1 KB = 1024 bytes
                        const fileSizeMB = fileSizeKB / 1024; // 1 MB = 1024 KB

                        var fixedMax = Math.floor(Math.random() * 12) + 83
                        var currentPercentage = 0;
                        var progressPercentage = Math.floor(70 / fileSizeMB);
                        var randomFraction = 1;
                        var randomNumberInRange = 1;
                        // upload-progress p tag add style as warning
                        let progressId; // Declare the interval ID variable

                        function updateProgress() {
                            randomFraction = Math.random();
                            randomNumberInRange = Math.floor(1 + (randomFraction * (4 - 1)));
                            currentPercentage += Math.ceil(progressPercentage);
                            $('.progress-bar').css('width', currentPercentage + '%');
                            $('.upload-progress h3').text(currentPercentage + '%');
                            // Check the condition you want
                            if (currentPercentage >= fixedMax) {
                                clearInterval(progressId); // Stop the interval when the condition is met
                            }
                        }

                        // Start the interval and store its ID
                        progressId = setInterval(updateProgress, randomNumberInRange * 500);

                    },
                    success: function(response) {
                        $('.btn-submit').attr('disabled', false).text('Upload');
                        var uri = response.uri;
                        var price = response.price;
                        //checkProgress(uri);
                        //uploadProgress.classList.add('d-none');
                        $('.progress-bar').css('width', '100%');
                        $('.upload-progress h3').text('Completed');
                        const progressBAR = document.querySelector('.progress-bar');
                        progressBAR.classList.remove('bg-warning');
                        progressBAR.classList.add('bg-success');
                        $('.upload-progress p').css('display', 'none');
                        window.location.href = baseUrl + '/instructor/courses/create/' +
                            course_id + '?tab=' + module_id;
                    },
                    // handle all types of errors
                    error: function(xhr) {
                        progressBAR.classList.remove('bg-danger');
                        uploadProgress.classList.add('d-none');
                        warnm.classList.add('d-none');
                        var errors = xhr.responseJSON.errors || xhr.responseJSON.message;
                        alert(errors);
                        console.log({
                            errors
                        })
                        $('.btn-submit').attr('disabled', false).text('Upload');
                    }
                });
            });
        });

        const videoInput = document.getElementById('uploadFile');
        const durationInput = document.getElementById('duration');

        videoInput.addEventListener('change', function() {
            const file = videoInput.files[0];
            if (file) {
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.preload = 'metadata';

                video.addEventListener('loadedmetadata', function() {
                    // Get the duration in seconds
                    const durationInSeconds = Math.floor(video.duration);
                    durationInput.value = durationInSeconds;
                });
            }
        });
</script>
@endsection