@extends('layouts.latest.admin')
@section('title')
Course Create - Step 4
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css') }}" rel="stylesheet" type="text/css" />
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
                <div class="highlighted-area-upload">
                    <img src="{{asset('latest/assets/images/icons/big-audio.svg')}}" alt="a" class="img-fluid">

                    <p><label for="audio">Click here</label> to set the highlighted audio</p>
                </div> 
                
                 <div class="course-content-box course-page-edit-box audio-preview">
                    <div class="title">
                        <div class="media">
                            <img id="audio-thumbnail" src="{{asset('latest/assets/images/icons/big-audio.svg')}}" alt="" class="img-fluid"> 
                            <div class="media-body">
                                <h5 id="file-name"></h5>
                                <span class="cursor-pointer" id="remove-audio">
                                    <i class="fas fa-close"></i>    
                                </span> 
                            </div>
                        </div>
                    </div>
                </div>
                {{-- uploaded audio preview --}}

                @if ($lesson->audio) 
                <div class="lesson-edit-form-wrap course-content-box course-page-edit-box flex-column mt-0">
                    <h4>Uploaded Audio:</h4>
                    <div class="title">
                        <div class="media">
                            <img id="audio-thumbnail" src="{{asset('latest/assets/images/icons/big-audio.svg')}}" alt="Audio" class="img-fluid"> 
                            <div class="media-body">
                                <h5>{{ $lesson->audio }} </h5> 
                            </div>
                        </div>
                    </div>
                </div> 

                @endif 

                <div class="lesson-edit-form-wrap mt-4">
                    <h4>{{$lesson->title}}</h4>

                    <form
                        action="{{ route('admin.course.lesson.audio.create',['id' => $lesson->course_id, 'module_id' => $lesson->module_id, 'lesson_id' => $lesson->id ,'subdomain' => config('app.subdomain')]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="d-none" id="audio" name="audio">
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description">
                                @if ($lesson->short_description)
                                {!! $lesson->short_description !!}
                                @endif
                            </textarea>
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
                    <a href="{{ url('admin/courses/create/'.$lesson->course_id) }}" class="btn-cancel">Back</a>
                    <button type="submit" class="btn btn-submit">Next</button>
                </div>
                {{-- step next bttns --}}
                </form>
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{asset('latest/assets/js/tinymce.js')}}" type="text/javascript"></script>

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
   // Replace with the appropriate event that triggers this function

    $('#audio-thumbnail').css('display', 'none');

    $('#audio').change(function () {
        var audioInput = $(this)[0];
        var audioPreview = $('#audio-preview');
        var fileNameSpan = $('#file-name');
        var removeAudioIcon = $('#remove-audio');

        if (audioInput.files.length > 0) {
            // Display the selected file name
            fileNameSpan.text(audioInput.files[0].name);

            // Hide the placeholder image by setting display: none
            $('#audio-thumbnail').css('display', 'block');

            // Show the remove audio icon
            removeAudioIcon.css('display', 'inline-block');
        } else {
            // No file selected, reset to the placeholder image
            fileNameSpan.text('');
            $('#audio-thumbnail').css('display', 'none');
            removeAudioIcon.hide();
        }
    });

    // Click event for the remove audio icon
    $('#remove-audio').click(function () {
        // Reset the input field
        $('#audio').val('');

        // Clear the file name and hide the remove audio icon
        $('#file-name').text('');
        $(this).hide();

        // Reset the display property of the placeholder image
        $('#audio-thumbnail').css('display', 'none');
    });

</script>
@endsection