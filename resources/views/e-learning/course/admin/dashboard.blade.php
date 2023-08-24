@extends('layouts.latest.admin')
@section('title')
Home Page
@endsection
{{-- page style @S --}}
@section('style')

@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="dashboard-page-wrap">
    <div class="container-fluid">
        <div class="row"> 
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                <!-- total client @s -->
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Students</h5>
                            <h4> {{ $studentsCount }}</h4>
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
                            <h5>Instructors</h5>
                            <h4> {{ $instructorsCount }}</h4>
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
                            <h5>Course</h5>
                            <h4> {{ $courseCount }}</h4>
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
                            <h5>Earnings</h5>
                            <h4>{{ $totalEarnings }}</h4>
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
                        <div class="col-lg-6">
                            <h5>Revenue</h5>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <p>All time stats <a href="#"><i class="fas fa-bars ms-4"></i></a></p>
                        </div>
                    </div>
                    <div id="earningChart"></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="top-performing-course mt-15">
                    <div class="d-flex">
                        <h5>Top Performing Courses</h5>
                        <a href="{{ url('admin/courses')}}">View All</a>
                    </div>
                    <div class="course-lists">
                    @php 
                        $sale_count = $TopPerformingCourses[0]->sale_count;
                        $sn = 1;
                    @endphp
                        @foreach ($TopPerformingCourses as $course)
                        @php 
                        if($course->sale_count < $sale_count && $sn < 3){
                            $sale_count = $course->sale_count;
                            $sn++;
                        }
                            
                        @endphp
                        <div class="media">
                            <img src="{{ asset('assets/images/courses/'.$course->thumbnail) }}" alt="Avatar" class="img-fluid">
                            <div class="media-body">
                                <h5><a href="{{url('admin/courses',$course->slug) }}"> {{ substr($course->title,0,20).'...'  }}</a></h5>
                                <p>{{ $course->categories}}</p>
                            </div>
                            <img src="{{ asset('latest/assets/images/tofy-'.$sn.'.svg')  }}" alt="Avatar" class="img-fluid">
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-xl-8">
                <div class="earnings-chart-wrap mt-15">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h5>Students</h5>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <p>All time stats <a href="#"><i class="fas fa-bars ms-4"></i></a></p>
                        </div>
                    </div>
                    <div id="lineChart"></div>
                </div>
            </div>  
            <div class="col-xl-4">
                <div class="top-performing-course mt-15"> 
                    <div class="d-flex">
                        <h5>Message</h5>
                        <a href="#">View All</a>
                    </div> 
                    <div class="messages-items-wrap"> 
                        @foreach ($lastMessages as $message)
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset('assets/images/users/'. $message->user->avatar) }}" alt="Avatar"
                                        class="img-fluid">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h5>{{ $message->user->name }} <span>{{ $message->created_at->diffForHumans() }}</span></h5>
                                    <p>{{ substr($message->message,0,34) }}</p>
                                </div>
                            </div> 
                        </div> 
                        @endforeach
                    </div> 
                </div>
            </div>
        </div> 
    </div> 
</main>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('dashboard-assets/js/clients-projects-chart.js') }}"></script>
<script src="{{ asset('dashboard-assets/js/multiple-chart.js') }}"></script>

<script src="{{ asset('dashboard-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('dashboard-assets/js/config.js') }}"></script>

<script>
    // donut Chart
        // const course_data = json($course_wise_payments);
        const course_data = {};

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