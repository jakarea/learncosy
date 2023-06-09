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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
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
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                <!-- total client @s -->
                <div class="card-box total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Earnings</h5>
                            <h4> {{ count($earningByDates) }}</h4>
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
                    <div id="earningChart"></div>
                </div>
                <!-- project statistic @e -->
            </div>


            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Monthly Earning </h5>
                    </div>
                    <div id="monthly_earning"></div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-4">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Course Earning</h5>
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
                            <p>New messages</p>
                        </div>
                        <!-- <a href="#" class="common-bttn">+New Messages</a> -->
                    </div>
                    <!-- header @e -->

                    <!-- messages list box @s -->
                    <div class="messages-items-wrap">
                        @foreach ($highLightMessages as $message)
                          <a href="{{ route('message') }}?sender={{ $message[0]->user->id}}">
                            <div class="messages-item">
                                
                                <div class="media">
                                    <div class="avatar">
                                        @if($message[0]->user->avatar == null)
                                           <img src="{{ asset('dashboard-assets/images/avatar.png') }}" alt="{{Auth()->user()->name}}"/>
                                        @else
                                            @if($message[0]->user->user_role == 'student')
                                                <img src="{{ asset('assets/images/students/'.$message[0]->user->avatar) }}" alt="{{Auth()->user()->name}}"/>
                                            @else
                                                <img src="{{ asset('assets/images/instructor/'.$message[0]->user->avatar) }}" alt="{{Auth()->user()->name}}"/>
                                            @endif
                                        @endif
                                        
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{$message[0]->user->name}} <i class="fa-solid fa-check-double"></i></h5>
                                        <p>{{$message[0]->message}}</p>
                                    </div>
                                </div>
                                <h6>  {{ Carbon\Carbon::parse($message[0]->created_at)->diffForHumans() }}</h6>
                            </div>
                          </a>
                        @endforeach
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
        // chart for Earnings
        const earnings = @json($earningByDates);
        const earningsKeys = Object.keys(earnings)
        const minDateForThisChart = earningsKeys.reduce((acc, current) => current < acc ? current : acc, earningsKeys[0])
        const dataForSeries = Object.entries(earnings).map(([key, value]) => {
            return [new Date(key).getTime(), value]
        })

        var options = {
            series: [{
                data: dataForSeries,
            }, ],
            chart: {
                id: "area-datetime",
                type: "area",
                height: 350,
                zoom: {
                    autoScaleYaxis: true,
                },
            },
            annotations: {
                yaxis: [{
                    y: 30,
                    borderColor: "#999",
                    label: {
                        show: true,
                        text: "Support",
                        style: {
                            color: "#fff",
                            background: "#00E396",
                        },
                    },
                }, ],
                xaxis: [{
                    x: new Date(Math.min(...(Object.keys(earnings)))).getTime(),
                    borderColor: "#999",
                    yAxisIndex: 0,
                    label: {
                        show: true,
                        text: "Rally",
                        style: {
                            color: "#fff",
                            background: "#775DD0",
                        },
                    },
                }, ],
            },
            dataLabels: {
                enabled: false,
            },
            markers: {
                size: 0,
                style: "hollow",
            },
            grid: {
                show: true,
                borderColor: "#D7D7D7",
                strokeDashArray: 0,
                position: "back",
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
                yaxis: {
                    lines: {
                        show: true,
                        opacity: 0.1,
                    },
                },
            },
            xaxis: {
                type: "datetime",
                min: minDateForThisChart,
                tickAmount: 6,
            },
            tooltip: {
                x: {
                    format: "dd MMM yyyy",
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 100],
                },
            },
        };


        var chart = new ApexCharts(document.querySelector("#earningChart"), options);
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

    <script>
// Earning by month
var earningByMonths = @json($earningByMonth);

var options = {
          series: [{
          name: 'Earning',
          data: earningByMonths
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return "€" + val ;
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#monthly_earning"), options);
        chart.render();
    </script>
@endsection
