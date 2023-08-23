@extends('layouts/latest/students')
@section('title') My Courses @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')

<main class="student-courses-lists-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <form action="">
                    <div class="user-search-box-wrap">
                        <div class="form-group">
                            <i class="fas fa-search"></i>
                            <input type="text" name="title" class="form-control" placeholder="Search course">
                        </div>
                        <div class="form-filter">
                            <select class="form-control">
                                <option value="">All </option>
                                <option value="">Most Purchased</option>
                                <option value="">Newest</option>
                                <option value="">Oldest</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="user-title-box">
                            <a href="{{ url('students/courses-activies') }}">Course Activity</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($enrolments as $enrolment) 
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box"> 
                        <img src="{{asset('assets/images/courses/'. $enrolment->course->thumbnail)}}" alt="{{ $enrolment->course->slug}}" class="img-fluid">
                    </div>
                    <div class="course-txt-box">
                        <a href="{{url('students/courses/'.$enrolment->course->slug )}}">  {{ Str::limit($enrolment->course->title, 50) }}</a>
                        <p>{{ Str::limit($enrolment->course->short_description, $limit = 32, $end = '...') }}</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <div class="course-progress-bar">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}" aria-valuemin="0" aria-valuemax="100">
                                @if (StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) == 100)
                                <div class="progress-bar" style="width: {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%; background: #32BCA3;"></div>
                                @else 
                                <div class="progress-bar" style="width: {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%"></div>
                                @endif
                                
                            </div> 
                            <div class="d-flex">
                                @if (StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) == 100)
                                <h6 style="color: #32BCA3">Completed</h6>
                                <h6 style="color: #32BCA3">{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }} %</h6>
                                @else  
                                <h6>Incomplete</h6>
                                <h6>{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }} %</h6>
                                @endif
                            </div>
                            
                        </div>
                    </div> 
                </div>
            </div>
            {{-- course single box end --}}
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                {{-- pagginate --}}
                <div class="paggination-wrap">
                    {{ $enrolments->links('pagination::bootstrap-5') }}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}} 