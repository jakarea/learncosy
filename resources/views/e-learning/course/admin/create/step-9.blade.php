@extends('layouts.latest.admin')
@section('title')
Course Create - Certificate
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
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                {{-- course step --}}
               <div class="course-create-step-wrap">
                <div class="step-box active">
                    <span class="circle">
                        <img src="{{ asset('latest/assets/images/icons/check-mark.svg') }}" alt="icon"
                            class="img-fluid">
                    </span>
                    <p><a href="{{ url('admin/courses/create', optional(request())->route('id')) }}">Contents</a></p>
                </div>
                <div class="step-box active">
                    <span class="circle">
                        <img src="{{ asset('latest/assets/images/icons/check-mark.svg') }}" alt="icon"
                            class="img-fluid">
                    </span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/facts' }}">Facts</a></p>
                </div>
                <div class="step-box active">
                    <span class="circle">
                        <img src="{{ asset('latest/assets/images/icons/check-mark.svg') }}" alt="icon"
                            class="img-fluid">
                    </span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/objects' }}">Objects</a></p>
                </div>
                <div class="step-box active">
                    <span class="circle">
                        <img src="{{ asset('latest/assets/images/icons/check-mark.svg') }}" alt="icon"
                            class="img-fluid">
                    </span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/price' }}">Price</a></p>
                </div>
                <div class="step-box active">
                    <span class="circle">
                        <img src="{{ asset('latest/assets/images/icons/check-mark.svg') }}" alt="icon"
                            class="img-fluid">
                    </span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/design' }}">Design</a></p>
                </div>
                <div class="step-box current">
                    <span class="circle"></span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/certificate' }}">Certificate</a></p>
                </div>
                <div class="step-box">
                    <span class="circle"></span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/visibility' }}">Visibility</a></p>
                </div>
                <div class="step-box">
                    <span class="circle"></span>
                    <p><a href="{{ url('admin/courses/create',optional(request())->route('id')).'/share' }}">Share</a></p>
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
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <h4><img src="{{asset('latest/assets/images/icons/gallery-icon.svg')}}" alt="gallery-icon"
                                class="img-fluid">Preview</h4>
                        <input type="file" class="d-none" id="certificate" name="sample_certificates">
                        <label for="certificate" class="file-up-box">
                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="gallery-icon"
                                class="img-fluid light-ele">
                            <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}" alt="gallery-icon"
                                class="img-fluid dark-ele">
                            <p><label for="certificate">Click to upload</label> or drag and drop <br> SVG, PNG, JPG or
                                GIF (max. 800x300px)</p>
                        </label>
                        <span class="invalid-feedback">@error('sample_certificates'){{ $message }} @enderror</span>
                    </div>
                    <div class="top-image-upload-box mt-2">
                        <img id="previewImage" src="" alt="" class="img-fluid rounded d-block w-100">
                        @if ($course->sample_certificates)
                        <img src="{{ asset($course->sample_certificates) }}" alt="" class="img-fluid rounded d-block w-100">
                        @endif
                    </div>
                    <div class="content-settings-form-wrap mt-0">
                        <h4>Certificate</h4>
                        <hr>
                        <div class="form-group">
                            <h6>Select Certificate</h6>
                            <select class="form-control" name="certificateStyle">
                                <option value="">Select Below</option>
                                @foreach ($certificates as $certificate)
                                    <option value="{{ $certificate->id }}" {{ $certificate->course_id ==  $course->id ? 'selected' : ''}}>{{ optional($certificate->course)->title }}
                                    </option>
                                @endforeach

                            </select>
                            <img src="{{asset('latest/assets/images/icons/arrow-down.svg')}}" alt="arrow-down"
                                class="img-fluid euro" style="top: 3rem">
                            <span class="invalid-feedback">@error('hascertificate'){{ $message }} @enderror</span>
                        </div>
                        <div class="media auto-text">
                            <div class="media-body">
                                <p>Or Create a new Certificate</p>
                            </div>
                            <a href="{{ route('account.settings', ['tab' => 'certificate', 'subdomain' => config('app.subdomain')]) }}" class="btn btn-primary"
                                target="_blank">Create</a>
                        </div>
                        <hr class="mb-0">
                    </div>

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="{{ url('admin/courses/create/'.$course->id.'/design')}}">Back</a>
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
document.getElementById('certificate').addEventListener('change', function (e) {
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