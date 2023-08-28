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
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="user-title-box">
                    <h1>Total: <span>{{ count($enrolments) }} Enroll Courses</span></h1>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="user-title-box justify-content-end">
                    <a href="{{ url('students/courses-activies') }}">Course Activity</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="GET">
                    <div class="user-search-box-wrap" style="grid-template-columns: 88% 12%">
                        <div class="form-group">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search Courses" class="form-control" name="title"
                                value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                        </div>

                        <div class="user-title-box justify-content-end">
                            <button type="submit" class="btn btn-search"><i class="fas fa-search text-white me-2"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if (count($enrolments) > 0)
            @foreach($enrolments as $enrolment) 
            {{-- course single box start --}}
            @php
                $review_sum = 0;
                $review_avg = 0;
                $total = 0;
                foreach($enrolment->course->reviews as $review){
                    $total++;
                    $review_sum += $review->star;
                }
                if($total)
                    $review_avg = $review_sum / $total;
            @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box"> 
                        <img src="{{asset('assets/images/courses/'. $enrolment->course->thumbnail)}}" alt="{{ $enrolment->course->slug}}" class="img-fluid">
                    </div>
                    <div class="course-txt-box">
                        <a href="{{url('students/courses/'.$enrolment->course->slug )}}">  {{ Str::limit($enrolment->course->title, 45) }}</a>
                        <p>{{ Str::limit($enrolment->course->short_description, $limit = 26, $end = '...') }}</p>
                        <ul>
                            <li><span>{{ $review_avg }}</span></li>
                            @for ($i = 0; $i<$review_avg; $i++)
                                <li><i class="fas fa-star"></i></li>
                            @endfor
                            <li><span>({{ $total }})</span></li>
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
            @else 
            <div class="col-12">
                <div class="no-result-found">
                    <h6>No Courses Found!</h6>
                </div>
            </div>
            @endif
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