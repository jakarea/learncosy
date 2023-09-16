@extends('layouts.latest.instructor')
@section('title', 'Instructor Analytics')
{{-- page style @S --}}
@section('style')

@endsection
@section('content') 
    <main class="dashboard-page-wrap"> 
        <div class="container-fluid">
            <div class="row">
                @can('instructor')
                <div class="col-12"> 
                    {!! isInstructorSubscribed(auth()->user()->id) !!}
                </div>
                @endcan
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                    <!-- total client @s -->
                    <div class="total-client-box">
                        <div class="media">
                            <div class="media-body">
                                <h5>Students</h5>
                                <h4>  {{ count($students) }} </h4>
                            </div> 
                        </div>
                        <p>All time stats</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                    </div>
                    <!-- total client @e -->
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                    <!-- total client @s -->
                    <div class="total-client-box">
                        <div class="media">
                            <div class="media-body">
                                <h5>Courses</h5>
                                <h4> {{ count($courses) }} </h4>
                            </div> 
                        </div>
                        <p>All time stats</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                    </div>
                    <!-- total client @e -->
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                    <!-- total client @s -->
                    <div class="total-client-box">
                        <div class="media">
                            <div class="media-body">
                                <h5>Earnings</h5>
                                <h4>{{ count($earningByDates) }} €</h4>
                            </div> 
                        </div>
                        <p>All time stats</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                    </div>
                    <!-- total client @e -->
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                    <!-- total client @s -->
                    <div class="total-client-box">
                        <div class="media">
                            <div class="media-body">
                                <h5>Sell Rating</h5>
                                <h4>35%</h4>
                            </div> 
                        </div>
                        <p>All time stats</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                    </div>
                    <!-- total client @e -->
                </div> 
            </div>
            <div class="row">
                <div class="col-12"> 
                    <div class="chart-box-wrap mt-15">
                        <div class="statics-head">
                            <h5>Earnings by date</h5>
                        </div> 
                        <div id="earningCh"></div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="chart-box-wrap mt-15">
                        <div class="statics-head">
                            <h5>Monthly Earning </h5>
                        </div>
                        <div id="chartEar"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="chart-box-wrap mt-15">
                        <div class="statics-head">
                            <h5>Course Earning</h5>
                        </div>
                        <div id="course_earning"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="chart-box-wrap mt-15">
                        <div class="statics-head">
                            <h5>Students</h5>
                        </div>
                        <div id="lineChart"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="top-performing-course mt-15"> 
                        <div class="d-flex">
                            <h5>Message</h5>
                            <a href="{{ url('course/messages') }}">View All</a>
                        </div>  
                        <div class="messages-items-wrap"> 
                            @foreach ($messages as $message)
                                <div class="messages-item">
                                    <div class="media">
                                        <div class="avatar">
                                            <img src="{{ asset('/assets/images/users/'.$message->user->avatar) }}" alt="Avatar"
                                                class="img-fluid">
                                            <i class="fas fa-circle"></i>
                                        </div>
                                        <div class="media-body">
                                            <h5>{{ $message->user->name }} <span>{{ $message->created_at->diffForHumans()}}</span></h5>
                                            <p>{{ $message->message }}</p>
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

const data = @json($activeInActiveStudents);

    var options = {
          series: [{
            name: "Active Students",
            data: data.active_students
        },{
            name: "Inactive Students",
            data: data.inactive_students
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        colors:['#294CFF','#FFAB00'], 
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
        show: true,
        borderColor: '#C2C6CE',
        strokeDashArray: 4,
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), options);
        chart.render();
</script>

<script>

    const earningsDate = @json($earningByDates);

    var options = {
          series: [{
            name: "Earning By Date",
            data: [earningsDate]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        colors:['#294CFF'], 
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
        show: true,
        borderColor: '#C2C6CE',
        strokeDashArray: 4,
        },
        xaxis: {
          categories: ['1 Jul', '5 Jul', '10 Jul', '15 Jul', '20 Jul', '25 Jul', '30 Jul'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#earningCh"), options);
        chart.render();
</script>

<script>

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
        colors:['#294CFF', '#E7EBFF'],
        plotOptions: { 
          bar: {
            horizontal: false,
            columnWidth: '60%',
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
          categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
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
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chartEar"), options);
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
