@extends('layouts.latest.instructor')
@section('title', 'Instructor Analytics')
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<main class="dashboard-page-wrap">
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
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Students</h5>
                            <h4> {{ count($students) }} </h4>
                        </div>
                    </div>
                    <p> <b style="color: {{  $formatedPercentageChangeOfStudentEnroll >= 0 ? 'green' : 'red' }}">{{
                            number_format($formatedPercentageChangeOfStudentEnroll, 0) }}</b> % VS last month</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">

                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Courses</h5>
                            <h4> {{ count($courses) }} </h4>
                        </div>
                    </div>
                    <p> <b style="color: {{ $formatedPercentageOfCourse >= 0 ? 'green' : 'red' }}">{{
                            number_format($formatedPercentageOfCourse,0) }}</b> % VS last month</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>

            </div>
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Earnings</h5>
                            <h4>{{ count($earningByDates) }} €</h4>
                        </div>
                    </div>
                    <p> <b style="color: {{ $formattedPercentageChangeOfEarning >= 0 ? 'green' : 'red' }}">{{
                            number_format($formattedPercentageChangeOfEarning,0) }}</b> % VS last month</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>

            </div>
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
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
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-15">
                <div class="chart-box-wrap">
                    <div class="statics-head">
                        <h5>Earnings</h5>
                    </div>
                    <div id="chart-earnings"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mt-15">
                <div class="chart-box-wrap">
                    <div class="statics-head">
                        <h5>Monthly Earning</h5>
                    </div>
                    <div id="monthlyEarningGraph"></div>
                </div>
            </div>
            <div class="col-lg-4 mt-15">
                <div class="chart-box-wrap">
                    <div class="statics-head">
                        <h5>Course Progress</h5>
                    </div>
                    <div class="course-progress-box">
                        <div class="txt">
                            <h5>{{ count($courses) }}</h5>
                            <p>Total Courses</p>
                        </div>
                        <canvas id="courseProgress"></canvas>
                        <div id="legend" class="legend"></div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mt-15">
                <div class="chart-box-wrap">
                    <div class="statics-head">
                        <h5>Students</h5>
                    </div>
                    <div id="studentsGraph"></div>
                </div>
            </div>
            <div class="col-lg-4 mt-15">
                <div class="top-performing-course">
                    <div class="d-flex">
                        <h5>Message</h5>
                        @if (count($messages) > 0)
                            <a href="{{ url('course/messages') }}">View All</a>
                        @endif
                    </div>
                    <div class="messages-items-wrap">
                        @if (count($messages) > 0) 
                        @foreach ($messages as $message)
                        <div class="messages-item">
                            <div class="media">
                                <div class="avatar">
                                    <img src="{{ asset($message->user->avatar) }}" alt="Avatar" class="img-fluid">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h5>{{ $message->user->name }} <span>{{
                                            $message->created_at->diffForHumans()}}</span></h5>
                                    <p>{{ $message->message }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else 
                        @include('partials/no-data')
                        @endif
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

{{-- statudents status start --}}
<script>
    const data = @json($activeInActiveStudents);

        var options = {
          series: [{
          name: 'Active Students',
          data: data.active_students
        }, {
          name: 'Inactive Students',
          data: data.inactive_students
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        grid: {
        show: true,
        borderColor: '#C2C6CE',
        strokeDashArray: 0,
        xaxis: {
                lines: {
                    show: false
                }
            },
        }, 
        colors:['#00AB55', '#FFAB00'],
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        }; 

        var chart = new ApexCharts(document.querySelector("#studentsGraph"), options);
        chart.render();
</script>
{{-- statudents status end --}}

{{-- Total earnings start --}}
<script>
    const earningsDate = @json($earningByDates);

    var options = {
          series: [{
          data: [
            earningsDate
          ] 
        }],
          chart: {
          id: 'area-datetime',
          type: 'area',
          height: 350,
          zoom: {
            autoScaleYaxis: true
          }
        }, 
        dataLabels: {
          enabled: false
        },
        colors:['#294CFF', '#E7EBFF'],
        markers: {
          size: 0,
          style: 'hollow',
        },
        xaxis: {
          type: 'datetime',
          min: new Date('01 Mar 2012').getTime(),
          tickAmount: 6,
        },
        tooltip: {
          x: {
            format: 'dd MMM yyyy'
          }
        },
        grid: {
        show: true,
        borderColor: '#C2C6CE',
        strokeDashArray: 0,
        xaxis: {
                lines: {
                    show: false
                }
            },
        }, 
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 100]
          }
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart-earnings"), options);
        chart.render(); 

</script>
{{-- Total earnings end --}}

{{-- monthly earning start --}}
<script>
    const earningsByMonths = @json($earningByMonth);

    var options = {
          series: [{
          name: 'Monthly Earnings',
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
            columnWidth: '50%',
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

        var chart = new ApexCharts(document.querySelector("#monthlyEarningGraph"), options);
        chart.render();
</script>
{{-- monthly earning end --}}

{{-- course progress chart start --}}
<script>
    var datas = [ {{$activeCourses = 2}}, {{$draftCourses}}];
    var backgroundColor = ['#FFAB00', '#294CFF'];
    var ctx = document.getElementById('courseProgress').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Complete', 'Inprogress'],
            datasets: [{
                label: 'Course Progress',
                data: datas,
                backgroundColor: backgroundColor,
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
                text: 'Chart Donut'
            },
            legend: {
                display: false
            },
            cutout: '70%',
            radius: 120
        }
    });

    // Calculate percentages
    var total = datas.reduce((a, b) => a + b, 0);
    var percentages = datas.map((value) => ((value / total) * 100).toFixed(0) + "%");

    // Generate and display the custom legend
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
{{-- course progress chart end --}}
@endsection