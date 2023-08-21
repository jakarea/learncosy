@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 8
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
            <div class="col-12 col-md-10 col-lg-7 col-xl-6">
                {{-- course step --}}
                {{-- add class "active" to "step-box" for the done step and add a checkmark image icon inside "circle"
                class --}}
                {{-- add class "current" to "step-box" for the current step --}}
                <div class="course-create-step-wrap">
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Contents</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Facts</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
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
                <form action="">
                    <div class="top-image-upload-box">
                        <h4><img src="{{asset('latest/assets/images/icons/gallery-icon.svg')}}" alt="gallery-icon" class="img-fluid"> Image</h4>
                        <input type="file" class="d-none" id="fileInput">
                        <label for="fileInput" class="file-up-box">
                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="gallery-icon" class="img-fluid">
                            <p><label for="fileInput">Click to upload</label> or drag and drop <br> SVG, PNG, JPG or GIF (max. 800x300px)</p>
                        </label>
                    </div>
                    <div class="top-image-upload-box mt-2">
                        <img id="previewImage" src="" alt="No Image Uploaded yet" class="img-fluid">
                    </div> 
                    
                    <div class="content-settings-form-wrap mt-0">
                        <h4>Appearance Course</h4>
                        <div class="form-group">
                            <input id="name" class="form-control" type="text" required>
                            <label for="name">Appearance Product Overview</label>
                            <span class="d-block mt-3"><img src="{{asset('latest/assets/images/icons/eye-2.svg')}}"
                                    alt="gallery-icon" class="img-fluid"> Preview</span>
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
                        <a href="#">Back</a>
                        <a href="#">Next</a>
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
document.getElementById('fileInput').addEventListener('change', function (e) {
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