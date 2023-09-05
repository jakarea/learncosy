@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 9
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
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Design</p>
                    </div>
                    <div class="step-box current">
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
                        <h4><img src="{{asset('latest/assets/images/icons/gallery-icon.svg')}}" alt="gallery-icon" class="img-fluid"> Preview</h4>
                        <input type="file" class="d-none" id="fileInput">
                        <label for="fileInput" class="file-up-box">
                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="gallery-icon" class="img-fluid light-ele">
                            <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}" alt="gallery-icon" class="img-fluid dark-ele">
                            <p><label for="fileInput">Click to upload</label> or drag and drop <br> SVG, PNG, JPG or GIF (max. 800x300px)</p>
                        </label>
                    </div>
                    <div class="top-image-upload-box mt-2">
                        <img id="previewImage" src="" alt="No Image Uploaded yet" class="img-fluid">
                    </div> 
                    <div class="content-settings-form-wrap mt-0">
                        <h4>Certificate</h4>
                        <hr>
                        <div class="form-group">
                            <h6>Select Certificate</h6>
                             <select class="form-control">
                                <option value="">No</option>
                                <option value="">Yes</option>
                             </select>
                             <img src="{{asset('latest/assets/images/icons/arrow-down.svg')}}" alt="arrow-down" class="img-fluid euro" style="top: 3rem">
                        </div>   
                        <div class="media auto-text">
                            <div class="media-body"> 
                                <p>Or Create a new Certificate</p>
                            </div>
                            <a href="#" class="btn btn-primary">Create</a>
                        </div> 
                        <hr class="mb-0">
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