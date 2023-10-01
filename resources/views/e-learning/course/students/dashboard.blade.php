@extends('layouts/latest/students')
@section('title')
Students Dashboard
@endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/ins-dashboard.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="student-dashboard-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="yearly-analitics">
                    <h1>Yearly Analytics</h1>

                    {{-- yearly filter box --}}
                    <div class="dropdown">
                        <button type="button" class="btn btn-filter" data-bs-toggle="dropdown"
                            aria-expanded="false"><img src="{{ asset('latest/assets/images/icons/filter.svg') }}"
                                alt="a" class="img-fluid"> Filters</button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">One Month</a></li>
                            <li><a class="dropdown-item" href="#">Three Months</a></li>
                            <li><a class="dropdown-item" href="#">Six Months</a></li>
                            <li><a class="dropdown-item" href="#">One Year</a></li>
                        </ul>
                    </div>
                    {{-- yearly filter box --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Course in Progress</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Completed Course</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Watching Time</p>
                    <div class="d-flex">
                        <h5 style="font-size: 25px; font-weight:bold;">{{ secondsToHms($totalTimeSpend)}}</h5>
                        <span>
                            @if ($percentageChange > 0)
                            <img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Up"
                                class="img-fluid">
                            @elseif ($percentageChange < 0) <img
                                src="{{ asset('latest/assets/images/icons/arrow-down.svg') }}" alt="Down"
                                class="img-fluid">
                                @endif
                                {{ abs($percentageChange) }}%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Certificate Achievement</p>
                    <div class="d-flex">
                        <h5>0</h5>
                        <span><img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Test"
                                class="img-fluid"> 100%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 mt-15">
                <div class="earnings-chart-wrap pb-0">
                    <div class="row align-items-start">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center">
                                <h5>Time Spending</h5>
                                <h3 class="ms-4">{{ $totalHours }}<sub class="text-muted"
                                        style="font-size: 1rem">h</sub>
                                    {{ $totalMinutes }}<sub class="text-muted" style="font-size: 1rem">m</sub></h3>
                            </div>
                        </div>
                    </div>
                    <div id="timeSpendingChart"></div>
                </div>
            </div>
            <div class="col-xl-4 mt-15">
                <div class="top-performing-course fixed-height">
                    <div class="d-flex justify-content-between w-100">
                        <h5>My Profile</h5>
                        <a href="{{ url('students/profile/myprofile') }}">View Profile</a>
                    </div>
                    <div class="profile-widget-wrapper">
                        <div class="profile-widget-inner">

                            @if (auth()->user()->avatar)
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                class="img-fluid" width="100">
                            @else
                            <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                            @endif
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
            <div class="col-lg-8 mt-15">
                <div class="my-courses-box">
                    <h3>Liked Courses </h3>
                    <div class="course-box-overflown">
                        @if (count($likeCourses) > 0)
                        @foreach ($likeCourses as $likeCourse)
                        <div class="media">
                            @if ($likeCourse->course->thumbnail)
                            <img src="{{ asset($likeCourse->course->thumbnail) }}" alt="a" class="img-fluid me-3"
                                style="width: 100px; border-radius: 1rem">
                            @else
                            <img src="{{ asset('latest/assets/images/course-small.svg') }}" alt="a"
                                class="img-fluid me-3">
                            @endif
                            <div class="media-body">
                                <h5>{{ $likeCourse->course->title }}</h5>
                                <p><strong>Fee:</strong>

                                    {{ $likeCourse->course->offer_price ? $likeCourse->course->offer_price :
                                    $likeCourse->course->price }}
                                    €
                                </p>
                                <ul class="mt-1">
                                    <li><i class="fas fa-calendar me-2"></i>
                                        {{ $likeCourse->course->created_at->format('F j, Y') }}
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ url('students/courses/' . $likeCourse->course->slug) }}"><i
                                    class="fa-solid fa-ellipsis-vertical"></i></a>
                        </div>
                        @endforeach
                        @else
                        @include('partials/no-data')
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4">
                <div class="course-progress-circle mt-15">
                    <h5>Course Statistics</h5>
                    @if (count(studentRadarChart(auth()->user()->id)['labels']) > 0)
                    @foreach (studentRadarChart(auth()->user()->id)['labels'] as $key => $label)
                    <div class="student_summery_chart">
                        <figure class="text-center">
                            <div class="chart" id="graph{{ $key + 1 }}"
                                data-percent="{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}"
                                data-color="#4C60FF"></div>
                        </figure>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div> --}}
            <div class="col-lg-4 mt-15">
                <div class="chart-box-wrap">
                    <div class="statics-head">
                        <h5>Course Statistics</h5>
                    </div>
                    <div class="course-progress-box">
                        <div class="txt">
                            <h5>{{ count($enrolments) }}</h5>
                            <p>Total Courses</p>
                        </div>
                        <canvas id="myCourseStatics"></canvas>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-12 mt-15">
                <div class="course-status-wrap">
                    <div class="d-flex">
                        <h4>Course Status</h4>
                        @if (count($enrolments)  > 3)
                        <div>
                            <a href="{{ url('students/dashboard/enrolled') }}" class="me-0">View All</a>
                        </div>
                        @endif
                        
                    </div>
                    @if (count($enrolments)  > 0) 
                    <table>
                        <tr>
                            <th width="40%">Course Name</th>
                            <th>Paid</th>
                            <th width="22%">Progress</th>
                            <th>Start Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                        @foreach ($enrolments->slice(0, 4) as $enrolment) 
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar">
                                            <img src="{{ asset($enrolment->course->thumbnail) }}" alt="Thumb"
                                                class="img-fluid">
                                        </div>
                                        <div class="media-body">
                                            <h5>{{$enrolment->course->title}}</h5>
                                            <p>{{ $enrolment->course->platform }} </p> 
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>€ {{$enrolment->amount}}</p>
                                </td>
                                @php 
                                    $courseProgress = null;
                                    $courseProgress = StudentActitviesProgress(auth()->user()->id, $enrolment->course->id);  
                                @endphp
                                <td>
                                    <p>{{ $courseProgress }}%</p>
                                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $courseProgress }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: {{ $courseProgress }}%"></div>
                                    </div>
                                </td>
                                <td>
                                    <p>{{ $enrolment->created_at->format('d-F-Y') }}</p>
                                </td>
                                <td class="text-end">
                                    <a href="{{ url('students/courses/'.$enrolment->course->slug) }}">Play</a>
                                </td>
                            </tr> 
                        @endforeach
                    </table>
                    @else 
                    @include('partials/no-data')
                    @endif
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

{{-- course statics old start --}}
<script>
    jQuery(document).ready(function() {

            var el;
            var options;
            var canvas;
            var span;
            var ctx;
            var radius;

            var createCanvasVariable = function(id) { // get canvas
                el = document.getElementById(id);
            };

            var createAllVariables = function() {
                options = {
                    percent: el.getAttribute('data-percent') || 25,
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

            var drawNewGraph = function(id) {
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
{{-- course statics old end --}}

{{-- time spend chart start --}}
<script>
    jQuery(document).ready(function() {
            var timeSpentData = @json($timeSpentData);
            var options = {
                series: [{
                    name: "Time spend",
                    data: timeSpentData.map(item => item.time_spent), 
                }],
                chart: {
                    height: 280,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#294CFF'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: timeSpentData.map(item => item.month),
                }
            };
            var chart = new ApexCharts(document.querySelector("#timeSpendingChart"), options);
            chart.render();
        });
</script>
{{-- time spend chart end --}}

{{-- course statics chart start --}}
<script>
    new Chart(document.getElementById('myCourseStatics'),{
        type: 'doughnut',
        data: {
            labels: [
                'Complete',
                'Inprogress',
                'Not Started',
            ],
            datasets: [{
                label: 'Course Progress',
                data: [40, 25,35],
                backgroundColor: [
                '#00B8D9',
                '#00AB55',
                '#FFAB00'
                ],
                hoverOffset: 4
            }]
	    },
        options: {
            title: {
                display: true,
                text: 'Course Statics'
            },
            legend: {
                position: 'bottom'
            },
            cutout: '88%',
            radius: 120
        }

    })
</script>
{{-- course statics chart end --}}
@endsection
{{-- page script @E --}}