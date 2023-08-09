@extends('layouts/latest/students')
@section('title') Home Page @endsection

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
            <div class="col-lg-4">
                <div class="status-card-box">
                    <p>Course in Progress</p>
                    <div class="d-flex">
                        <h5>06</h5>
                        <span><img src="{{asset('latest/assets/images/icons/arrow-up.svg')}}" alt="Test" class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                    <h5 class="p-3 pb-0 my-course">My Courses</h5>
                    <table class="my-tabl">
                        <tr>
                            <th width="5%"><i class="fa-solid fa-bars-staggered"></i> No</th>
                            <th><i class="fa-solid fa-book-open"></i> Course Name</th>
                            <th><i class="fa-solid fa-money-bill"></i> Paid</th>
                            <th><i class="fa-solid fa-calendar-day"></i> Start Date</th>
                            <th><i class="fa-solid fa-headset"></i> Support</a></th> 
                        </tr>
                        {{-- item @S --}}
                        @php
                        $i = 0;
                        @endphp
                        @foreach($enrolments as $enrolment)
                        @php
                        $i++
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td> <a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{
                                    $enrolment->course->title}} </a> </td>
                            <td>{{ $enrolment->amount}}</td>
                            <td>{{ $enrolment->created_at->format('F j, Y')}}</td>
                            <td><a class="contact_bttn" href="{{ url('course/messages/send',$enrolment->course->id)}}"
                                    target="_blank" rel="noopener noreferrer"> Contact </td>
                        </tr>
                        @endforeach 
                    </table> 
                </div>
            </div>
        </div>
        <div class="row">
            @if ( count(studentRadarChart(auth()->user()->id)['labels'] ) > 0 )
            @foreach(studentRadarChart(auth()->user()->id)['labels'] as $key => $label)
            <div class="col-4">
                <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                    <h6 class="p-3 pb-0 my-course"> {{ \Str::limit($label, 20) }}</h6>
                    <div class="student_summery d-flex justify-content-between align-items-center">
                        <div class="student_summery_content p-3">
                            <ul>
                                <li><span><i class="fa-solid fa-thumbs-up text-primary"></i> Lesson</span> <span>{{
                                        studentRadarChart(auth()->user()->id)['lesson'][$key] }}</span></li>
                                <li><span><i class="fa-solid fa-thumbs-up text-primary"></i> Module</span> <span>{{
                                        studentRadarChart(auth()->user()->id)['modules'][$key] }}</span></li>
                                <li><span><i class="fa-solid fa-thumbs-up text-primary"></i> In Progress</span>
                                    <span>{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="student_summery_chart">
                            <figure class="text-center">
                                <div class="chart" id="graph{{ $key+1 }}"
                                    data-percent="{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}"
                                    data-color="#4C60FF"></div>
                                <!-- <figcaption><h3>Web design</h3></figcaption> -->
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                    <h6 class="p-3 pb-0 my-course"> No Course Found</h6>
                </div>
            </div>
            @endif
        </div>
    </div> -->

    <div class="container-fluid">
        <div class="row">
            @can('instructor')
            <div class="col-12 mb-4">
                <!-- Check if not purchase subscription then show alert with subscription link -->
                {!! isInstructorSubscribed(auth()->user()->id) !!}
            </div>
            @endcan
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Course In Progress</h5>
                            <h4> 0</h4>
                        </div> 
                    </div>
                    <p>All time stats</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid">
                </div>
                <!-- total client @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Completed Courses</h5>
                            <h4> 0</h4>
                        </div> 
                    </div>
                    <p>All time stats</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid">
                </div>
                <!-- total client @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Watching Time</h5>
                            <h4> 0</h4>
                        </div> 
                    </div>
                    <p>All time stats</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid">
                </div>
                <!-- total client @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Certificate Achivement</h5>
                            <h4>0</h4>
                        </div> 
                    </div>
                    <p>All time stats</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid">
                </div>
                <!-- total client @e -->
            </div> 
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="earnings-chart-wrap mt-15">
                    <div class="row align-items-center">
                        <div class="col-lg-10">
                            <h5>Time Spending</h5>
                            <h3>10<sub class="text-muted">h</sub>
                            6<sub class="text-muted">m</sub></h3>
                        </div>
                        <div class="col-lg-2 text-lg-end">
                            <select class="form-select form-select-sm border-0">
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
                        <a href="#">View All</a>
                    </div>
                    <div class="profile-widget-wrapper py-4">
                        <div class="profile-widget-inner text-center">
                            <img src="{{ asset('latest/assets/images/avatar-circle.png') }}" alt="Avatar" class="img-fluid" width="100">
                            <div class="profile-widget-info mt-2">
                                <h6 class="text-small">{{ auth()->user()->name }}</h6>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="profile-widget-history mx-5 mt-4 text-center bg-light rounded p-3">
                            <ul class="d-flex justify-content-between">
                                <li>
                                    <h6>10</h6>
                                    <p class="text-muted">Rank</p>
                                </li>
                                <li>
                                    <h6>2h</h6>
                                    <p class="text-muted">Avr. hour</p>
                                </li>
                                <li>
                                    <h6>12</h6>
                                    <p class="text-muted">Enrolled</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-xl-8">
                <div class="earnings-chart-wrap mt-15">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h5>Liked Courses</h5>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <p>All time stats <a href="#"><i class="fas fa-bars ms-4"></i></a></p>
                        </div>
                    </div>
                    <!-- <div id="lineChart"></div> -->
                    <div class="messages-items-wrap"> 
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('latest/assets/images/men-avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h5>Ronald Richards <span>4:45 Pm</span></h5>
                                    <p>The More Important the Work, the More Rest</p>
                                </div>
                            </div> 
                        </div> 
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('latest/assets/images/men-avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h5>Ronald Richards <span>4:45 Pm</span></h5>
                                    <p>The More Important the Work, the More Rest</p>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>  
            <div class="col-xl-4">
                <div class="top-performing-course mt-15"> 
                    <div class="d-flex">
                        <h5>Course Statistics</h5>
                        <a href="#">View All</a>
                    </div> 
     
                    <div class="messages-items-wrap"> 
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('latest/assets/images/men-avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h5>Ronald Richards <span>4:45 Pm</span></h5>
                                    <p>The More Important the Work, the More Rest</p>
                                </div>
                            </div> 
                        </div> 
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('latest/assets/images/men-avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h5>Ronald Richards <span>4:45 Pm</span></h5>
                                    <p>The More Important the Work, the More Rest</p>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="earnings-chart-wrap mt-15">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h5>Statistics</h5>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <p>All time stats <a href="#"><i class="fas fa-bars ms-4"></i></a></p>
                        </div>
                    </div>
                    <div id="monthly_earning"></div>
                </div>
            </div>
        </div>
    </div> 
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