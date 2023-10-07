@extends('layouts.latest.instructor')
@section('title', 'Instructor Analytics')
{{-- page style @S --}}
@section('style')

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
                            <button type="button" class="btn btn-filter" data-bs-toggle="dropdown" aria-expanded="false"
                                id="filterDropdownButton">
                                <img src="{{ asset('latest/assets/images/icons/filter.svg') }}" alt="a"
                                    class="img-fluid"> Filters
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-duration="one_month">One
                                        Month</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-duration="three_months">Three
                                        Months</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-duration="six_months">Six
                                        Months</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-duration="one_year">One
                                        Year</a></li>
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
                        <p> <b
                                style="color: {{ $formatedPercentageChangeOfStudentEnroll >= 0 ? 'green' : 'red' }}">{{ number_format($formatedPercentageChangeOfStudentEnroll, 0) }}</b>
                            % VS last month</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
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
                        <p> <b
                                style="color: {{ $formatedPercentageOfCourse >= 0 ? 'green' : 'red' }}">{{ number_format($formatedPercentageOfCourse, 0) }}</b>
                            % VS last month</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
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
                        <p> <b
                                style="color: {{ $formattedPercentageChangeOfEarning >= 0 ? 'green' : 'red' }}">{{ number_format($formattedPercentageChangeOfEarning, 0) }}</b>
                            % VS last month</p>
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart"
                            class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
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
                        <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart"
                            class="img-fluid light-ele">
                        <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart"
                            class="img-fluid dark-ele">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-15">
                    <div class="chart-box-wrap">
                        <div class="statics-head">
                            <h5>Earnings</h5>
                        </div>
                        {{-- <div id="chart-earnings"></div> --}}
                        <div id="chart"></div>

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
                                                <img src="{{ asset($message->user->avatar) }}" alt="Avatar"
                                                    class="img-fluid">
                                                <i class="fas fa-circle"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5>{{ $message->user->name }}
                                                    <span>{{ $message->created_at->diffForHumans() }}</span>
                                                </h5>
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
    {{-- <script src="{{ asset('dashboard-assets/js/clients-projects-chart.js') }}"></script> --}}

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
            colors: ['#00AB55', '#FFAB00'],
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
        document.addEventListener("DOMContentLoaded", function() {
            const data = @json($earningByDates);

            const chartData = Object.keys(data).map((date) => {
                return {
                    x: new Date(date).getTime(),
                    y: data[date]
                };
            });

            var options = {
                chart: {
                    type: 'line',
                    height: 350,
                },
                xaxis: {
                    type: 'datetime',
                },
                series: [{
                    name: 'Earnings',
                    data: chartData,
                }],
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
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
            colors: ['#294CFF', '#E7EBFF'],
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
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
                    formatter: function(val) {
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
        new Chart(document.getElementById('courseProgress'), {
            type: 'doughnut',
            data: {
                labels: [
                    'Complete',
                    'Inprogress'
                ],
                datasets: [{
                    label: 'Course Progress',
                    data: [70, 30],
                    backgroundColor: [
                        '#294CFF',
                        '#FFAB00'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Chart Donut'
                },
                legend: {
                    position: 'bottom'
                },
                cutout: '70%',
                radius: 120
            }

        })
    </script>


    <script>
        $(document).ready(function() {
            // Event listener for filter options
            $(".filter-option").click(function(e) {
                e.preventDefault();
                var duration = $(this).data("duration");

                // Update the URL with the selected filter duration as a query parameter
                var currentUrl = window.location.href;
                var updatedUrl = updateQueryStringParameter(currentUrl, 'duration', duration);
                history.pushState({
                    path: updatedUrl
                }, '', updatedUrl);

                // Reload the page or perform other actions as needed
                window.location.reload();
            });

            // Function to update query parameters in the URL
            function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }
        });
    </script>

@endsection
