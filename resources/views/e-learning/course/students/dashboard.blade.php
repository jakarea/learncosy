@extends('layouts/latest/students')
@section('title','Student Dashboard')

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
                        <h5>{{ $inProgressCount }}</h5>
                        @php 
                            $totalCoureses = count($enrolments);
                            $progPercentage = ($inProgressCount / $totalCoureses) * 100;
                        @endphp 
                        <span>
                            <img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Test" class="img-fluid">
                            {{$progPercentage}}%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Completed Course</p>
                    <div class="d-flex">
                        <h5>{{ $completedCount }}</h5>
                        @php 
                            $totalCoureses = count($enrolments);
                            $cmpltPercentage = ($completedCount / $totalCoureses) * 100;
                        @endphp 
                        <span>
                            <img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Test" class="img-fluid">
                            {{$cmpltPercentage}}%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Watching Time</p>
                    <div class="d-flex"> 
                        <h5>{{ $totalHours }}h <b style="font-size: 1.25rem; font-weight:600">{{ $totalMinutes }}m</b></h5>
                        <span>
                            @if ($percentageChange > 0)
                            <img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Up"
                                class="img-fluid">
                            @elseif ($percentageChange < 0) <img
                                src="{{ asset('latest/assets/images/icons/arrow-down.svg') }}" alt="Down"
                                class="img-fluid">
                                @endif
                                {{ number_format(abs($percentageChange), 2) }}%
                        </span>
                    </div>
                </div>
            </div>   

            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="status-card-box">
                    <p>Certificate Achievement</p>

                    @php
                    $totalEnrolledCourses = count($certificateCourses);
                    $completedCoursesCount = 0;
                    @endphp

                    @foreach ($certificateCourses as $certificateCourse)
                        @php 
                        $totalProgressPercent = StudentActitviesProgress(auth()->user()->id, $certificateCourse->id);

                        if ($totalProgressPercent >= 100) {
                            $completedCoursesCount++;
                        }
                        @endphp
                    @endforeach

                    <div class="d-flex">
                        <h5>{{ $completedCoursesCount }}</h5>
                        <span><img src="{{ asset('latest/assets/images/icons/arrow-up.svg') }}" alt="Test"
                                class="img-fluid"> {{ $totalEnrolledCourses > 0 ? ($completedCoursesCount / $totalEnrolledCourses) * 100 : 0 }}%</span>
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
                                <h6>{{ $total_hr }}h:{{ $total_min }}m</h6>
                                <p>Avr. hour</p>
                            </li>
                            <li>
                                <h6>{{ $enrolled }}</h6>
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
                    <div class="course-box-overflown liked-courses">
                        @if (count($likeCourses) > 0)
                        @foreach ($likeCourses as $likeCourse) 
                        @php
                         $totalLessons = 0;
                            foreach ($likeCourse->course->modules as $module) {
                                $totalLessons = count($module->lessons);
                            }
                        @endphp  
                        <div class="media">
                            @if ($likeCourse->course->thumbnail)
                            <img src="{{ asset($likeCourse->course->thumbnail) }}" alt="a" class="img-fluid me-3 thumab">
                            @else
                            <img src="{{ asset('latest/assets/images/course-small.svg') }}" alt="a"
                                class="img-fluid me-3 thumab">
                            @endif
                            <div class="media-body">
                                <h5>{{ $likeCourse->course->title }}</h5>
                                <p class="user"><i class="fa-solid fa-user"></i> {{ $likeCourse->course->user->name }} &nbsp; - &nbsp;{{ $likeCourse->course->platform }}</p>  
                                <p class="lessons">
                                    <img src="{{ asset('latest/assets/images/icons/modules.svg') }}" alt="a" class="img-fluid">
                                     {{ count($likeCourse->course->modules) }} Modules &nbsp;&nbsp; 
                                     <img src="{{ asset('latest/assets/images/icons/modules.svg') }}" alt="a" class="img-fluid"> {{ $totalLessons }} Lessons
                                </p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn btn-filter" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i
                                    class="fa-solid fa-ellipsis-vertical"></i></button>
        
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ route('students.course.unlike',['course_id' => $likeCourse->course->id, 'ins_id' => $likeCourse->course->user_id]) }}" method="POST" class="d-block">
                                            @csrf
                                            <button type="submit" class="btn p-0 dropdown-item">Unlike</button>
                                        </form> 
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('students/courses/'.$likeCourse->course->slug) }}">Play</a></li> 
                                </ul>
                            </div> 
                        </div>
                        @endforeach
                        @else
                            @include('partials/no-data')
                        @endif
                    </div>
                </div>
            </div>
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
                        <div id="legend"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-15">
                <div class="course-status-wrap">
                    <div class="d-flex">
                        <h4>Course Status</h4>
                        @if (count($enrolments) > 3)
                        <div>
                            <a href="{{ url('students/dashboard/enrolled') }}" class="me-0">View All</a>
                        </div>
                        @endif

                    </div>
                    @if (count($enrolments) > 0)
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
                                <div class="progress" role="progressbar" aria-label="Basic example"
                                    aria-valuenow="{{ $courseProgress }}" aria-valuemin="0" aria-valuemax="100">
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
                    toolbar: {
                        show: false
                    },
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
    let completedCount = @json($completedCount);
    let notStartedCount = @json($notStartedCount);
    let inProgressCount = @json($inProgressCount);

    var data = [completedCount, inProgressCount, notStartedCount];
    var total = data.reduce((a, b) => a + b, 0);
    var percentages = data.map((value) => ((value / total) * 100).toFixed(0) + "%");

    var ctx = document.getElementById('myCourseStatics').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Complete',
                'Inprogress',
                'Not Started',
            ],
            datasets: [{
                label: 'Course Progress',
                data: data,
                backgroundColor: [
                    '#00AB55',
                    '#00B8D9',
                    '#FFAB00'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                display: false
                }
            },
            title: {
                display: true,
                text: 'Course Statistics'
            },
            legend: {
                display: false,
            },
            tooltips: {
                enabled: false
            },
            cutout: '88%',
            radius: 120,
        },
    });

    var legendHtml = "<ul>";
    for (var i = 0; i < myDoughnutChart.data.labels.length; i++) {
        legendHtml +=
            '<li>' + '<p> <span style="background-color:' +
            myDoughnutChart.data.datasets[0].backgroundColor[i] +
            '"></span> ' + myDoughnutChart.data.labels[i] + '</p>' + '<h6>' + percentages[i] + '</h6>' +
            "</li>";
    }
    legendHtml += "</ul>";

    document.getElementById("legend").innerHTML = legendHtml;
</script>
{{-- course statics chart end --}}
@endsection
{{-- page script @E --}}