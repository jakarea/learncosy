@extends('layouts/latest/students')
@section('title') Students Dashboard @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')

<main class="student-dashboard-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Course in Progress</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{asset('latest/assets/images/icons/arrow-up.svg')}}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Completed Course</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{asset('latest/assets/images/icons/arrow-up.svg')}}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Watching Time</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{asset('latest/assets/images/icons/arrow-up.svg')}}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Certificate Achievement</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{asset('latest/assets/images/icons/arrow-up.svg')}}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="earnings-chart-wrap mt-15">
                    <div class="row align-items-start">
                        <div class="col-lg-10 time-chart">
                            <h5>Time Spending</h5>
                            <h3>10<sub class="text-muted">h</sub>
                                6<sub class="text-muted">m</sub></h3>
                        </div>
                        <div class="col-lg-2 text-lg-end">
                            <select class="time-chart-select">
                                <option>Last 30 Days</option>
                                <option>Last 20 Days</option>
                                <option>Last 10 Days</option>
                            </select>
                        </div>
                    </div>
                    <div id="earningChart"></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="top-performing-course mt-15">
                    <div class="d-flex">
                        <h5>My Profile</h5>
                        <a href="{{url('students/profile/myprofile')}}">View Profile</a>
                    </div>
                    <div class="profile-widget-wrapper">
                        <div class="profile-widget-inner">
                            <img src="{{ asset('latest/assets/images/avatar-circle.png') }}" alt="Avatar"
                                class="img-fluid" width="100">
                            <div class="profile-widget-info mt-2">
                                <h6 class="text-small">{{ auth()->user()->name }}</h6>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <ul class="profile-widget-history">
                            <li>
                                <h6>10</h6>
                                <p>Rank</p>
                            </li>
                            <li>
                                <h6>2h</h6>
                                <p>Avr. hour</p>
                            </li>
                            <li>
                                <h6>12</h6>
                                <p>Enrolled</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="my-course-box mt-15">
                    <h5>Liked Courses</h5> 
                    @php
                    $i = 0;
                    @endphp
                    @foreach($enrolments as $enrolment)
                    @php
                    $i++
                    @endphp 
                    <div class="media">
                       @if ($enrolment->course->thumbnail)
                       <img src="{{asset('assets/images/courses/'.$enrolment->course->thumbnail)}}" alt="a" class="img-fluid">
                        @else
                        <img src="{{asset('latest/assets/images/course-small.svg')}}" alt="a" class="img-fluid">
                       @endif
                        <div class="media-body">
                            <h6><a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{
                                $enrolment->course->title}} </a> </h6>
                            <p><strong>Enrolled Fee:</strong> {{ $enrolment->amount}} €</p>
                            <span><i class="fas fa-calendar me-2"></i> {{ $enrolment->created_at->format('F j, Y')}}</span>
                        </div>
                        <a href="{{ url('course/messages/send',$enrolment->course->id)}}" target="_blank" class="bttn"><i class="fa-solid fa-headset me-2"></i> Contact</a>
                    </div>
                    @endforeach 
                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-progress-circle mt-15">
                    <h5>Course Statistics</h5>
                    @if ( count(studentRadarChart(auth()->user()->id)['labels'] ) > 0 )
                    @foreach(studentRadarChart(auth()->user()->id)['labels'] as $key => $label)
                    <div class="student_summery_chart">
                        <figure class="text-center">
                            <div class="chart" id="graph{{ $key+1 }}"
                                data-percent="{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}"
                                data-color="#4C60FF"></div>
                            <!-- <figcaption><h3>Web design</h3></figcaption> -->
                        </figure>
                    </div>
                    @endforeach
                    @endif 
                </div>
            </div>
        </div>
        <div class="row">
            @if ( count(studentRadarChart(auth()->user()->id)['labels'] ) > 0 )
            @foreach(studentRadarChart(auth()->user()->id)['labels'] as $key => $label)
            <div class="col-lg-12">
                <div class="course-progress-content mt-15">
                    <h5> {{ \Str::limit($label, 20) }}</h5>
                    <ul>
                        <li><span><i class="fas fa-circle-info"></i> Lesson</span> <span>{{
                                studentRadarChart(auth()->user()->id)['lesson'][$key] }}</span></li>
                        <li><span><i class="fas fa-circle-info"></i> Module</span> <span>{{
                                studentRadarChart(auth()->user()->id)['modules'][$key] }}</span></li>
                        <li><span><i class="fas fa-circle-info"></i> In Progress</span>
                            <span>{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <div class="text-center">
                   <h6>No Course Found</h6>
                </div>
            </div>
            @endif
        </div> 
    </div> -->
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function	(){

    var el;
    var options;
    var canvas;
    var span;
    var ctx;
    var radius;

    var createCanvasVariable = function(id){  // get canvas
        el = document.getElementById(id);
    };

    var createAllVariables = function(){
        options = {
            percent:  el.getAttribute('data-percent') || 25,
            size: el.getAttribute('data-size') || 120,
            lineWidth: el.getAttribute('data-line') || 10,
            rotate: el.getAttribute('data-rotate') || 0,
            color: el.getAttribute('data-color')
        };

        canvas = document.createElement('canvas');
        span = document.createElement('span');
        span.textContent = options.percent + '%';

        if (typeof(G_vmlCanvasManager) !== 'undefined') {
            G_vmlCanvasManager.initElement(canvas);
        }

        ctx = canvas.getContext('2d');
        canvas.width = canvas.height = options.size;

        el.appendChild(span);
        el.appendChild(canvas);

        ctx.translate(options.size / 2, options.size / 2); // change center
        ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

        radius = (options.size - options.lineWidth) / 2;
    };


    var drawCircle = function(color, lineWidth, percent) {
        percent = Math.min(Math.max(0, percent || 1), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = 'square'; // butt, round or square
        ctx.lineWidth = lineWidth;
        ctx.stroke();
    };

    var drawNewGraph = function(id){
        el = document.getElementById(id);
        createAllVariables();
        drawCircle('#efefef', options.lineWidth, 100 / 100);
        drawCircle(options.color, options.lineWidth, options.percent / 100);


    };
    // drawNewGraph('graph1');
    var graph = document.getElementsByClassName('chart');
    for (var i = 0; i < graph.length; i++) {
        drawNewGraph(graph[i].id);
    }

});

</script>
@endsection
{{-- page script @E --}}