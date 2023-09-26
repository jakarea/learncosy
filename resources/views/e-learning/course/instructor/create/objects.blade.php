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
                            @foreach (explode(', ', $course->objective) as $objective)
                            <div class="item">
                                <i class="fas fa-check"></i>
                                <input type="text" value="{{ $objective }}" class="form-control" name="objective[]">
                                <div class="actions">
                                    <a href="#" class="me-2 edit">
                                        <img src="{{asset('latest/assets/images/icons/pen-m.svg')}}" alt="Edit"
                                            class="img-fluid">
                                    </a>
                                    <a href="#" class="delete-item">
                                        <img src="{{asset('latest/assets/images/icons/minus-m.svg')}}" alt="Add"
                                            class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @endforeach 
                            @else 
                            <div class="item">
                                <i class="fas fa-check"></i>
                                <input type="text" value="{{ old('objective') }}" class="form-control" name="objective[]" placeholder="Enter object name here">
                                 
                            </div>
                            @endif
                            <div id="container-for-items">
                                {{-- Input Filed from js will append here --}}
                            </div>
                        </div> 
                        <div class="form-group">
                            <h6>Object Details</h6>
                            <textarea class="form-control" name="objective_details"
                                id="description">{{ $course->objective_details ? $course->objective_details :  old('objective_details') }}</textarea>
                        </div>
                        <div class="submit-bttns-box">
                            <button class="btn btn-cancel" type="reset">Cancel</button>
                            <button class="btn btn-submit" type="submit">Save</button>
                        </div> 
                        <div class="add-object">
                            <button class="btn btn-add" type="button" id="add-item-button"><i class="fas fa-plus"></i> Add Object</button>
                        </div>  
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

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>

<script> 
// append new input filed
   document.getElementById('add-item-button').addEventListener('click', function() {
    var newItem = document.createElement('div');
    newItem.classList.add('item'); 
    newItem.innerHTML = `
        <i class="fas fa-check"></i>
        <input type="text" value="" class="form-control" name="objective[]" placeholder="Enter object name here">
        <div class="actions"> 
            <a href="#" class="close-item ms-2">
                <img src="{{asset('latest/assets/images/icons/minus-m.svg')}}" alt="Remove" class="img-fluid">
            </a>
        </div>
    `; 
    document.getElementById('container-for-items').appendChild(newItem); 
    newItem.querySelector('.close-item').addEventListener('click', function(e) {
        e.preventDefault();
        newItem.remove();
    });
});

// on click delete items
let itemsd = document.querySelectorAll('.delete-item');
itemsd.forEach(itemd => {
    itemd.addEventListener('click', (e) => {  
        e.preventDefault();
        itemd.parentNode.parentNode.remove();
    });
});

// add active class on click
let itemsz = document.querySelectorAll('.edit');
itemsz.forEach(itemz => {
    itemz.addEventListener('click', (e) => {  
        e.preventDefault();
        itemsz.forEach(i => i.parentNode.parentNode.classList.remove('active')); 
        itemz.parentNode.parentNode.classList.add('active');
    });
});
</script>

@endsection