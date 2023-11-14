@extends('layouts.latest.instructor')
@section('title')
    Course Create - Step 3
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
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    {{-- course step --}}
                    <div class="course-create-step-wrap">
                        <div class="step-box active">
                            <span class="circle">
                                <img src="{{ asset('latest/assets/images/icons/check-mark.svg') }}" alt="icon"
                                    class="img-fluid">
                            </span>
                            <p>Contents</p>
                        </div>
                        <div class="step-box current">
                            <span class="circle">

                            </span>
                            <p>Facts</p>
                        </div>
                        <div class="step-box">
                            <span class="circle"></span>
                            <p>Objects</p>
                        </div>
                        <div class="step-box">
                            <span class="circle"></span>
                            <p>Price</p>
                        </div>
                        <div class="step-box">
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
                    <form action="{{ route('course.store.step-1', [$course ? $course->id : '']) }}" method="POST">
                        @csrf
                        <div class="content-settings-form-wrap">
                            <h4>Course Information</h4>
                            <div class="form-group">
                                <input id="title" name="title" class="form-control" type="text"
                                    value="{{ $course ? $course->title : old('title') }}">
                                <label for="title">Title</label>
                                <span class="invalid-feedback">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <input id="slug" name="slug" class="form-control" type="text"
                                    value="{{ $course ? $course->slug : old('slug') }}">
                                <label for="slug">Slug</label>
                            </div>
                            <div class="form-group">
                                <h6>Short Description</h6>
                                <textarea class="form-control" placeholder="Enter Short Description" name="short_description" id="short_description">{{ $course ? $course->short_description : old('short_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <h6>Description</h6>
                                <textarea class="form-control" name="description" id="description">{{ $course ? $course->description : old('description') }}</textarea>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <h6>User must manually tick off each lesson</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="auto_complete" role="switch"
                                        id="flexSwitchCheckChecked" checked>
                                </div>
                            </div>

                            <div class="form-group">
                                <h6>Language</h6>
                                <input id="language" name="language" class="form-control" placeholder="Language"
                                    type="text" value="{{ $course ? $course->language : old('language') }}">
                            </div>
                            <div class="form-group">
                                <h6>Platform</h6>
                                <input id="platform" name="platform" class="form-control"
                                    placeholder="ex: Figma/ Adobe XD/ Photoshop" type="text"
                                    value="{{ $course ? $course->platform : old('platform') }}">
                            </div>
                        </div>

                        {{-- step next bttns --}}
                        <div class="back-next-bttns">
                            <a href="{{ url('instructor/courses/create/' . $course->id) }}" class="btn-cancel">Back</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('keyup', function() {
            const titleValue = titleInput.value;
            const slugValue = slugify(titleValue);
            slugInput.value = slugValue; // Set the slug value 
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }
    </script>

<script src="https://cdn.tiny.cloud/1/your-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>;
<script>
    var isDarkMode = document.body.classList.contains('dark-mode');

// Initialize TinyMCE with the correct mode
tinymce.init({
    selector: '#description',
    plugins: 'powerpaste casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
    toolbar: 'undo redo print spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify lineheight | checklist bullist numlist indent outdent | removeformat',
    height: '300px',
    skin: isDarkMode ? "oxide-dark" : "oxide",
    content_css: isDarkMode ? "dark" : "default",

});
</script>
@endsection
