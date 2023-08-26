
@extends('layouts/latest/students')
@section('title') Course Home Page @endsection

@section('seo')
<meta name="description"
    content="Explore a diverse course list on LearnCosy. Boost your skills with engaging lessons in technology, business, arts, and more. Begin your educational journey today and unlock your full potential. Discover now!"
    itemprop="description">
@endsection
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
                            <input type="text" name="title" class="form-control" placeholder="Search course"
                                value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
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
                            <button type="submit" class="btn">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($courses as $course)
            @php
                $review_sum = 0;
                $review_avg = 0;
                $total = 0;
                foreach($course->reviews as $review){
                    $total++;
                    $review_sum += $review->star;
                }
                if($total)
                    $review_avg = $review_sum / $total;


                $desc = $course->short_description;
                $max_length = 205;
                if (strlen($desc) > $max_length) {
                $short_description = substr($desc, 0, $max_length);
                $last_space = strrpos($short_description, ' ');
                $short_description = substr($short_description, 0, $last_space) . " ...";
                } else {
                    $short_description = $desc;
                }
            @endphp
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-3">
                <div class="course-single-item">
                    <button class="btn btn-ellip" type="button">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <div class="course-thumb-box">
                        <img src="{{asset('assets/images/courses/'. $course->thumbnail)}}" alt="{{ $course->slug}}"
                            class="img-fluid">
                    </div>
                    <div class="course-ol-box">
                        <h5>{{ Str::limit($course->title, 60) }}</h5>
                        <span>Last Update: {{date('M d Y ', strtotime($course->updated_at)) }}</span>
                        <h6>{{ Str::limit($course->short_description, $limit = 90, $end = '...') }}</h6>
                        @php
                        $features = explode(",", $course->features);
                        $limitedItems = array_slice($features, 0, 4);
                        @endphp
                        <ul>
                            @foreach ($limitedItems as $feature)
                            <li><i class="fas fa-check"></i> {{$feature}}</li>
                            @endforeach
                        </ul>
                        @if ( !isEnrolled($course->id) )
                        <form action="{{route('students.checkout', $course->slug)}}" method="GET">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="price" value="{{$course->price}}">
                            <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">
                            <button type="submit" class="btn enrol-bttn">Buy Course Now</button>
                        </form>  
                        @else 
                        <a href="{{url('students/courses/overview/'.$course->slug )}}">Go to Course</a>
                        @endif 
                    </div>
                    <div class="course-txt-box">
                        @if ( isEnrolled($course->id) )
                            <a href="{{url('students/courses/my-courses/details/'.$course->slug )}}"> {{ Str::limit($course->title, 45) }}</a>
                        @else 
                            <a href="{{url('students/courses/overview/'.$course->slug )}}"> {{ Str::limit($course->title, 50) }}</a>
                        @endif
                        
                        <p>{{ Str::limit($course->short_description, $limit = 46, $end = '...') }}</p>
                        <ul>
                            <li><span>{{ $review_avg }}</span></li>
                            @for ($i = 0; $i<$review_avg; $i++)
                                <li><i class="fas fa-star"></i></li>
                            @endfor
                            <li><span>({{ $total }})</span></li>
                        </ul>
                        <h5>€ {{ $course->offer_price }} <span>€ {{ $course->price }}</span></h5>
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
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')

@endsection