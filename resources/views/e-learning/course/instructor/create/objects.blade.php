@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 3
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
                    <div class="step-box current">
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
                <form action="" method="POST">
                    @csrf
                    <div class="content-settings-form-wrap">
                        <h4>What You'll Learn</h4>

                        <div class="object-list-wrap">
                            @if (!empty($course->objective))
                            @foreach (explode(',', $course->objective) as $index => $objective)
                            <div class="item">
                                <i class="fas fa-check"></i>
                                <input type="text" value="{{ $objective }}" class="form-control" disabled>
                                <div class="actions">
                                    <a href="#" class="me-2 edit-item" data-index="{{ $index }}">
                                        <img src="{{ asset('latest/assets/images/icons/pen-m.svg') }}" alt="Edit"
                                            class="img-fluid">
                                    </a>
                                    <a href="#" class="delete-item" data-index="{{ $index }}">
                                        <img src="{{ asset('latest/assets/images/icons/minus-m.svg') }}" alt="Delete"
                                            class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @endif

                        </div>
                        <div class="form-group">
                            <h6>Object Title</h6>
                            <textarea class="form-control" name="objective[]" placeholder="Enter objective"
                                id="objective">{{ old('objective') }}</textarea>
                        </div>
                        <div class="submit-bttns-box">
                            <button class="btn btn-cancel" type="reset">Cancel</button>
                            <button class="btn btn-submit" type="submit">Save</button>
                        </div>
                        {{-- <div class="add-object">
                            <button class="btn btn-add" type="button" id="add-item-button"><i class="fas fa-plus"></i>
                                Add Object</button>
                        </div> --}}
                    </div>

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="{{url('instructor/courses/create/'.$course->id.'/facts')}}" class="btn-cancel">Back</a>
                        <a href="{{url('instructor/courses/create/'.$course->id.'/price')}}" class="btn-submit">Next</a>
                    </div>
                    {{-- step next bttns --}}
                </form>
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

{{-- script js --}}
@section('script')
<script> 

    document.addEventListener('DOMContentLoaded', function () {
        let currentURL = window.location.href;
        const baseUrl = currentURL.split('/').slice(0, 3).join('/'); 
        const deleteItem = document.querySelectorAll('.delete-item');
 
        deleteItem.forEach(item => {
            item.addEventListener('click', function() {

                item.parentNode.parentNode.style.display = 'none'; 
                let courseId = @json($course->id);  
                let dataIndex = item.getAttribute('data-index');  
                 
                    if (courseId) {
                        fetch(`${baseUrl}/instructor/courses/create/${courseId}/delete-objects/${dataIndex}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message === 'DONE') {
                                    item.parentNode.parentNode.style.display = 'none'; 

                                } else {
                                    item.parentNode.parentNode.style.display = 'block'; 
                                }
                            })
                            .catch(error => {
                                item.parentNode.parentNode.style.display = 'block'; 
                            });
                    }
                });


            });
        });
         
</script>
@endsection
{{-- script js --}}