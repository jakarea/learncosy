@extends('layouts.latest.admin')
@section('title')
    Home Page
@endsection
{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
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
                        <p> <b
                                style="color: {{ $percentageChangeOfStudent >= 0 ? 'green' : 'red' }}">{{ $percentageChangeOfStudent >= 0 ? '+' . $percentageChangeOfStudent : $percentageChangeOfStudent }}%</b>
                            VS last month</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
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

                        <p> <b
                                style="color: {{ $percentageChangeOfCourse >= 0 ? 'green' : 'red' }}">{{ $percentageChangeOfInstructor >= 0 ? '+' . $percentageChangeOfInstructor : $percentageChangeOfInstructor }}%</b>
                            VS last month</p>

                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
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
                        <p> <b
                                style="color: {{ $percentageChangeOfCourse >= 0 ? 'green' : 'red' }}">{{ $percentageChangeOfCourse >= 0 ? '+' . $percentageChangeOfCourse : $percentageChangeOfCourse }}%</b>
                            VS last month</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart"
                            class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
                    </div>
                    <!-- total client @e -->
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                    <!-- total client @s -->
                    <div class="total-client-box">
                        <div class="media">
                            <div class="media-body">
                                <h5>Earnings</h5>
                                <h4>€ {{ $totalEarnings }} </h4>
                            </div>
                        </div>

                        <p> <b
                                style="color: {{ $earningParcentage >= 0 ? 'green' : 'red' }}">{{ $earningParcentage >= 0 ? '+' . $earningParcentage : $earningParcentage }}%</b>
                            VS last month</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart"
                            class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
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
                        {{-- <div id="earningChart"></div> --}}
                        <div id="chartEar"></div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="top-performing-course mt-15">
                        <div class="d-flex">
                            <h5>Top Performing Courses</h5>
                            <a href="{{ url('admin/top-perform/courses') }}">View All</a>
                        </div>
                        <div class="course-lists ms-0">
                            @if (count($TopPerformingCourses))
                                @php
                                    $sale_count = $TopPerformingCourses[0]->sale_count;
                                    $sn = 1;
                                @endphp
                                @foreach ($TopPerformingCourses as $course)
                                    @php
                                        if ($course->sale_count < $sale_count && $sn < 3) {
                                            $sale_count = $course->sale_count;
                                            $sn++;
                                        }
                                        
                                    @endphp
                                    <div class="media">
                                        <img src="{{ asset($course->thumbnail) }}" alt="Avatar" class="img-fluid">
                                        <div class="media-body">
                                            <h5><a href="{{ url('admin/courses', $course->slug) }}">
                                                    {{ substr($course->title, 0, 20) . '...' }}</a></h5>
                                            <p> {{ $course->categories }} </p>
                                        </div>
                                        <img src="{{ asset('latest/assets/images/tofy-' . $sn . '.svg') }}" alt="Avatar"
                                            class="img-fluid me-0">
                                    </div>
                                @endforeach
                            @else
                                @include('partials/no-data')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="course-status-wrap mt-15">
                        <div class="d-flex">
                            <h4>Course Status</h4>
                            <div>
                                <a href="{{ url('admin/courses') }}" class="me-0">View All</a>
                            </div>
                        </div>
                        <table>
                            <tr>
                                <th>Course Name</th>
                                <th>Price</th>
                                <th>Rating</th>
                                <th>Earning</th>
                                <th class="text-end">Sell</th>
                            </tr>

                            @foreach ($courses as $course)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="avatar">
                                                <img src="{{ asset($course->thumbnail) }}" alt="c-status"
                                                    class="img-fluid">
                                            </div>
                                            <div class="media-body">
                                                <h5>{{ substr($course->title, 0, 35) }}</h5>
                                                <p> {{ $course->categories }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p>{{ ($course->offer_price ? ($price = $course->offer_price) : ($price = $course->price)) ? '€' . $price : 'Free' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p><i class="fas fa-star" style="color: #F8AA00;"></i>
                                            {{ number_format($course->avg_rating, 1) }}</p>
                                    </td>
                                    <td>
                                        <p>€{{ $course->sum_amount ? $course->sum_amount : 0 }}</p>
                                    </td>
                                    <td class="text-end">
                                        <p>{{ $course->sale_count }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
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
                                            <img src="{{ asset( $message->user->avatar) }}"
                                                alt="Avatar" class="img-fluid">
                                            <i class="fas fa-circle"></i>
                                        </div>
                                        <div class="media-body">
                                            <h5>{{ $message->user->name }}
                                                <span>{{ $message->created_at->diffForHumans() }}</span>
                                            </h5>
                                            <p>{{ substr($message->message, 0, 34) }}</p>
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
                type: "bar",
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


        const earningsByMonths = @json($earningByMonth);

        var options = {
            series: [{
                name: 'Total Sales',
                data: earningsByMonths
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#294CFF', '#E7EBFF'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '75%',
                    borderRadius: 2,
                    endingShape: 'rounded',

                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: '€'
                }
            },
            fill: {
                opacity: 1
            },
            grid: {
                show: true,
                borderColor: '#C2C6CE',
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "€ " + val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartEar"), options);
        chart.render();

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
                formatter: function(val) {
                    return "€" + val;
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
                    formatter: function(val) {
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
