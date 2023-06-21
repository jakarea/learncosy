@extends('layouts/instructor')
@section('title', 'Dashboard')
{{-- page style @S --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/dashboard.css') }}">
    <link href="{{ asset('dashboard-assets/css/responsive.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@900&display=swap" rel="stylesheet">

    <style>
        .blink {
            animation: blink-animation 1s steps(2, start) infinite;
        }

        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }
    </style>

@endsection
@section('content')
    <!-- dashboard page wrapper @s -->
    <main class="common-page-wrap dashboard-page-wrap">
        <!-- dashboard chart box @s -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-12 col-xxl-12">
                <!-- Check if not purchase subscription then show alert with subscription link -->
                {!! isInstructorSubscribed(auth()->user()->id) !!}
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="card-box total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Students</h5>
                            <h4> {{ count($students) }}</h4>
                        </div>
                        <img src="{{ asset('dashboard-assets/images/chart-1.svg') }}" alt="Chart" class="img-fluid">
                    </div>
                </div>
                <!-- total client @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="card-box total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Course</h5>
                            <h4> {{ count($courses) }}</h4>
                        </div>
                        <img src="{{ asset('assets/images/graph-8.svg') }}" alt="Chart" class="img-fluid">
                    </div>
                </div>
                <!-- total client @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="card-box total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Earnings</h5>
                            <h4> 432</h4>
                        </div>
                        <img src="{{ asset('assets/images/graph-8.svg') }}" alt="Chart" class="img-fluid">
                    </div>
                </div>
                <!-- total client @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="card-box digital-clock-box">
                    <div id="clock">0:00 </div>
                </div>
                <!-- total client @e -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Earnings</h5>
                    </div>
                    <div id="chart-timeline"></div>
                </div>
                <!-- project statistic @e -->
            </div>


            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Statistics</h5>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-4">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Statistics</h5>
                    </div>
                    <div id="course_earning"></div>
                </div>
            </div>

        </div>
        <!-- dashboard chart box @e -->

        <!-- dashboard projects and messages box @s -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Students</h5>
                    </div>
                    <div id="lineChart"></div>
                </div>
                <!-- project statistic @e -->
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6">
                <!-- message box @s -->
                <div class="card-box message-main-box">
                    <!-- header @s -->
                    <div class="media headers">
                        <div class="media-body">
                            <h5>Messages</h5>
                            <p>Lorem ipsum dolor sit amet</p>
                        </div>
                        <a href="#" class="common-bttn">+New Messages</a>
                    </div>
                    <!-- header @e -->

                    <!-- messages list box @s -->
                    <div class="messages-items-wrap">
                        <!-- item @s -->
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('dashboard-assets/images/avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h5>Maren Rosser <i class="fa-solid fa-check-double"></i></h5>
                                    <p>Hei, dont forget to clear server cache!</p>
                                </div>
                            </div>
                            <h6>25min ago</h6>
                            <div class="action">
                                <a href="#">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a>
                            </div>
                        </div>
                        <!-- item @e -->
                        <!-- item @s -->
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('dashboard-assets/images/avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h5>Maren Rosser <i class="fa-solid fa-check-double"></i></h5>
                                    <p>Hei, dont forget to clear server cache!</p>
                                </div>
                            </div>
                            <h6>25min ago</h6>
                            <div class="action">
                                <a href="#">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a>
                            </div>
                        </div>
                        <!-- item @e -->
                        <!-- item @s -->
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('dashboard-assets/images/avatar.png') }}" alt="Avatar"
                                        class="img-fluid">
                                </div>
                                <div class="media-body">
                                    <h5>Maren Rosser </h5>
                                    <p>Hei, dont forget to clear server cache!</p>
                                </div>
                            </div>
                            <h6>25min ago</h6>
                            <div class="action">
                                <a href="#">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a>
                            </div>
                        </div>
                        <!-- item @e -->
                    </div>
                    <!-- messages list box @e -->
                </div>
                <!-- message box @e -->
            </div>
        </div>
        <!-- dashboard projects and messages box @e -->
    </main>
    <!-- dashboard page wrapper @e -->
@endsection
@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('dashboard-assets/js/clients-projects-chart.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/multiple-chart.js') }}"></script>

    <script src="{{ asset('dashboard-assets/js/box-chart.js') }}"></script>
    {{-- <script src="{{ asset('dashboard-assets/js/line-chart.js') }}"></script> --}}
    <script src="{{ asset('dashboard-assets/js/line-chart-2.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/config.js') }}"></script>

    <script>
        // donut Chart
        const course_data = @json($course_wise_payments);

        const indexes = [];
        const values = [];

        for (const [index, value] of Object.entries(course_data)) {
            indexes.push(index);
            values.push(value);
        }


        var options = {
            series: values,
            labels: indexes,
            chart: {
                type: 'donut',
                dropShadow: {
                    enabled: true,
                    color: '#111',
                    top: -1,
                    left: 3,
                    blur: 3,
                    opacity: 0.2
                }
            },
            stroke: {
                width: 0,
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                showAlways: true,
                                show: true
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#course_earning"), options);
        chart.render();
    </script>

    <script>
        // line chart for active and inactive students
        const data = @json($activeInActiveStudents);

        var options = {
            series: [{
                name: 'Active',
                data: data.active_students
            }, {
                name: 'Inactive',
                data: data.inactive_students
            }],
            chart: {
                height: 315,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [0, 0],
            },
            colors: ['#09BD3C', '#1D3573'],
            grid: {
                show: true,
                borderColor: '#D7D7D7',
                strokeDashArray: 0,
                position: 'back',
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true,
                        opacity: 1,
                    }
                },
            },
            xaxis: {
                type: 'datetime',
                categories: data.dates
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), options);
        chart.render();
    </script>

    <script>
        function updateClock() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var amPm = hours >= 12 ? 'PM' : 'AM';

            // Convert hours to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; // The hour '0' should be '12'

            // Add leading zeros to minutes if necessary
            minutes = minutes < 10 ? '0' + minutes : minutes;

            var clockDiv = document.getElementById('clock');
            clockDiv.innerHTML = hours + '<span class="blink">:</span>' + minutes + ' ' + amPm;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);
    </script>
@endsection
