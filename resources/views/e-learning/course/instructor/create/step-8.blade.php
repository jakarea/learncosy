@extends('layouts.latest.instructor')
@section('title')
Course Create - Design Step 
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
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                {{-- course step --}} 
                <div class="course-create-step-wrap">
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                                class="img-fluid">
                        </span>
                        <p>Contents</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Facts</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Objects</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Price</p>
                    </div>
                    <div class="step-box current">
                        <span class="circle"></span>
                        <p>Design</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Certificate</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Visibility</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Share</p>
                    </div>
                </div>
                {{-- course step --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="top-image-upload-box">
                        {{-- session message @S --}}
                    @include('partials/session-message')
                    {{-- session message @E --}}
                        <h4><img src="{{asset('latest/assets/images/icons/gallery-icon.svg')}}" alt="gallery-icon" class="img-fluid"> Image</h4>
                        <input type="file" class="d-none" id="thumbnail" name="thumbnail">
                        <label for="thumbnail" class="file-up-box">
                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="gallery-icon" class="img-fluid light-ele">
                            <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}" alt="gallery-icon" class="img-fluid dark-ele">
                            <p><label for="thumbnail">Click to upload</label> or drag and drop <br> SVG, PNG, JPG or GIF (max. 800x300px)</p>
                        </label>
                    </div>
                    <div class="top-image-upload-box mt-2">
                        <img id="previewImage" src="" alt="" class="img-fluid rounded">
                        @if ($course->thumbnail)
                            <img src="{{ asset($course->thumbnail) }}" alt="" class="img-fluid rounded">
                        @endif
                    </div> 
                    
                    <div class="content-settings-form-wrap mt-0">
                        <h4>Appearance Course</h4>
                        <div class="form-group">
                            <input id="name" class="form-control" type="text" value="{{ $course->title }}" required>
                            <label for="name">Appearance Product Overview</label>
                            <span class="d-block mt-3"><img src="{{asset('latest/assets/images/icons/eye-2.svg')}}"
                                    alt="gallery-icon" class="img-fluid"> <a href="{{url('instructor/courses/'.$course->slug)}}" target="_blank">Preview</a></span>
                        </div>
                        <div class="media auto-text">
                            <div class="media-body">
                                <h6>Automatically Add Numbers</h6>
                                <p>For example: Module 1 (Name), Module 2 (Name) etc.</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" checked>
                            </div>
                        </div>
                    </div> 

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="{{ url('instructor/courses/create/'.$course->id.'/price')}} ">Back</a>
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
<script>
    // Function to handle file input change
document.getElementById('thumbnail').addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (event) {
            const previewImage = document.getElementById('previewImage');
            previewImage.src = event.target.result;
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    }
});

</script>
@endsection