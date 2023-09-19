@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 1
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
                    <div class="step-box current">
                        <span class="circle"></span>
                        <p>Facts</p>
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
            <div class="col-12 col-md-10 col-lg-9 col-xl-8">

                

                <div class="content-step-wrap">
                    {{-- session message @S --}}
                    @include('partials/session-message')
                    {{-- session message @E --}}

                    @foreach ($modules as $module)
                    {{-- course with page --}}
                    <div class="course-with-page">
                        {{-- course content box start --}}
                        <div class="course-content-box course-content-inside">
                            <div class="title">
                                <div class="media">
                                    <img src="{{asset('latest/assets/images/icons/book.svg')}}" alt="Bar"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>{{ $module->title}}</h5>
                                        <p>Module with {{ count($module->lessons) }} lessons</p>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#lessonModal"><i class="fa-solid fa-ellipsis"></i></button>

                                <a href="#" class="accrodin-bttn"><i class="fas fa-angle-down"></i></a>
                            </div>
                        </div>
                        {{-- course content box end --}}

                        <div class="toggle-box-wrap">
                            @foreach ($module->lessons as $lesson)
                            {{-- course page box start --}}
                            <div class="course-content-box course-page-box">
                                <div class="title">
                                    <img src="{{asset('latest/assets/images/icons/bars-2.svg')}}" alt="Bar"
                                        class="img-fluid me-4">
                                    <div class="media">
                                        <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar"
                                            class="img-fluid">
                                        <div class="media-body">
                                            <h5>{{ $lesson->title }}</h5>
                                            <p>{{ $lesson->type }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            @if ($lesson->type == 'audio')
                                            <a class="dropdown-item" href="{{ url('instructor/courses/create/'.$lesson->course_id.'/audio/'.$lesson->id) }}">Add Content</a>
                                            @elseif($lesson->type == 'video')
                                            <a class="dropdown-item" href="{{ url('instructor/courses/create/'.$lesson->course_id.'/video/'.$lesson->id) }}">Add Content</a>
                                            @elseif($lesson->type == 'text')
                                            <a class="dropdown-item" href="{{ url('instructor/courses/create/'.$lesson->course_id.'/text/'.$lesson->id) }}">Add Content</a>
                                            @else 
                                            <a class="dropdown-item" href="#">Invalid Type</a>
                                            @endif
                                           
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#lessonAddModal_{{ $lesson->id }}">Edit Lesson</a></li>
                                        <form action="{{ route('lesson.destroy', $lesson->slug) }}" method="post" class="d-inline">
                                            @csrf 
                                            @method('delete')
                                            <li>
                                                <button type="submit" class="btn dropdown-item">Remove Lesson</button>
                                            </li>
                                        </form>
                                    </ul>

                                    <div class="course-name-modal">
                                        <div class="modal fade" id="lessonAddModal_{{ $lesson->id }}" tabindex="-1"
                                            aria-labelledby="lessonAddModal_{{ $lesson->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="course-name-txt">
                                                            <h5>Lesson name</h5>
                                                            <form action="{{ route('course.lesson.step.update',$lesson->id) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="module_id" value="{{$module->id}}">
                                                                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Enter Lesson Name" name="lesson_name" value="{{ $lesson->title }}" class="form-control">
                                                                </div>
                                                                <div class="page-type mb-4">
                                                                    <h6>Type</h6>

                                                                    <input type="hidden" name="lesson_type" class="inputField2" value="{{ $lesson->type }}">

                                                                    <div class="d-flex lesson-types2">
                                                                        <a href="#" data-values="text" class="{{ $lesson->type == 'text' ? 'active' : '' }}"><img
                                                                                src="{{asset('latest/assets/images/icons/file.svg')}}"
                                                                                alt="a" class="img-fluid"> Text</a>
                                                                        <a href="#" data-values="audio" class="{{ $lesson->type == 'audio' ? 'active' : '' }}"><img
                                                                                src="{{asset('latest/assets/images/icons/audio.svg')}}"
                                                                                alt="a" class="img-fluid"> Audio</a>
                                                                        <a href="#" class="{{ $lesson->type == 'video' ? 'active' : '' }}" data-values="video"><img
                                                                                src="{{asset('latest/assets/images/icons/video.svg')}}"
                                                                                alt="a" class="img-fluid"> Video</a>
                                                                    </div>

                                                                </div>
                                                                {{-- <div class="form-check form-switch">
                                                                    <label class="form-check-label" for="is_module">Is a
                                                                        Modual</label>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_module" value="1" role="switch"
                                                                        id="is_module" checked>
                                                                </div> --}}
                                                                <p>Select the Lesson type.</p>
                                                                <div class="form-submit">
                                                                    <button type="button" class="btn btn-cancel"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-submit">Next</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- course page box end --}}
                            @endforeach
 
                            {{-- course page add box start --}}
                            <div class="add-content-box mt-3">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#lessonModal_{{$module->id}}"><i class="fas fa-plus"></i> Add Lesson </button>
                            </div>
                            {{-- course page add box end --}}
                        </div>

                        {{-- lesson modal --}}
                        <div class="course-name-modal">
                            <div class="modal fade" id="lessonModal_{{$module->id}}" tabindex="-1"
                                aria-labelledby="lessonModal_{{$module->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="course-name-txt">
                                                <h5>Lesson name</h5>
                                                <form action="" method="post">
                                                    @csrf
                                                    <input type="hidden" name="module_id" value="{{$module->id}}">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Enter Lesson Name"
                                                            name="lesson_name" class="form-control">
                                                    </div>
                                                    <div class="page-type mb-4">
                                                        <h6>Type</h6>

                                                        <input type="hidden" name="lesson_type" class="inputField">

                                                        <div class="d-flex lesson-types"> 
                                                            <a href="#" data-value="text"><img
                                                                    src="{{asset('latest/assets/images/icons/file.svg')}}"
                                                                    alt="a" class="img-fluid"> Text</a>
                                                            <a href="#" data-value="audio"><img
                                                                    src="{{asset('latest/assets/images/icons/audio.svg')}}"
                                                                    alt="a" class="img-fluid"> Audio</a>
                                                            <a href="#" class="active" data-value="video"><img
                                                                    src="{{asset('latest/assets/images/icons/video.svg')}}"
                                                                    alt="a" class="img-fluid"> Video</a>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-check form-switch">
                                                        <label class="form-check-label" for="is_module">Is a
                                                            Modual</label>
                                                        <input class="form-check-input" type="checkbox" name="is_module"
                                                            value="1" role="switch" id="is_module" checked>
                                                    </div> --}}

                                                    <p>Select The Lesson type.</p>
                                                    <div class="form-submit">
                                                        <button type="button" class="btn btn-cancel"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-submit">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Lesson modal --}}

                    </div>
                    {{-- course with page --}}
                    @endforeach

                    {{-- course content add box start --}}
                    <div class="add-content-box">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#moduleModal"><i
                                class="fas fa-plus"></i> Add Module</button>
                    </div>
                    {{-- course content add box end --}}

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="{{ url('instructor/courses/create/step-2') }}">Back</a>
                        <a href="{{ url('instructor/courses/create/step-4') }}">Next</a>
                    </div>
                    {{-- step next bttns --}}
                </div>
            </div>
        </div>
    </div>
</main>

{{-- course name modal --}}
<div class="course-name-modal">
    <div class="modal fade" id="moduleModal" tabindex="-1" aria-labelledby="moduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="course-name-txt">
                        <h5>Module name</h5>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="Enter Module Name" name="module_name"
                                    class="form-control">
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="is_module">Is a Modual</label>
                                <input class="form-check-input" type="checkbox" name="is_module" value="1" role="switch"
                                    id="is_module" checked>
                            </div>
                            <p>Disable this if you want a separate content page.</p>
                            <div class="form-submit">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- course name modal --}}

@endsection
{{-- page content @E --}}

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".accrodin-bttn");
    buttons.forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            const toggleBoxWrap = this.parentElement.parentElement.parentElement.querySelector(".toggle-box-wrap"); 

            if (toggleBoxWrap) {

                this.querySelector(".fa-angle-down").classList.toggle("rotate");

                if (toggleBoxWrap.style.maxHeight) {
                    toggleBoxWrap.style.maxHeight = null;
                } else {
                    toggleBoxWrap.style.maxHeight = toggleBoxWrap.scrollHeight + "px";
                }
            }
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const typeBttns = document.querySelectorAll(".lesson-types a"); 
    let inputF = document.querySelector(".inputField"); 

    typeBttns.forEach(function(bttn) {
        bttn.addEventListener("click", function(e) {
            e.preventDefault();
            typeBttns.forEach(c => c.classList.remove("active"));
            this.classList.add("active");   
            inputF.value = this.getAttribute("data-value"); 
        });
    });

});

</script> 

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const typeBttns2 = document.querySelectorAll(".lesson-types2 a"); 
    let inputF2 = document.querySelector(".inputField2"); 

    typeBttns2.forEach(function(bttn2) {
        bttn2.addEventListener("click", function(e) {
            e.preventDefault();
            typeBttns2.forEach(c2 => c2.classList.remove("active"));
            this.classList.add("active");   
            inputF2.value = this.getAttribute("data-values"); 
        });
    });
});

</script> 
@endsection