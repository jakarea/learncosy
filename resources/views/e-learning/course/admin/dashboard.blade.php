@extends('layouts.latest.admin')
@section('title')
Home Page
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/ins-dashboard.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
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
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Students</h5>
                            <h4> {{ $studentsCount }}</h4>
                        </div>
                    </div>
                    <p> <b style="color: {{ $percentageChangeOfStudent >= 0 ? 'green' : 'red' }}">{{
                            $percentageChangeOfStudent >= 0 ? '+' . $percentageChangeOfStudent :
                            $percentageChangeOfStudent }}%</b>
                        VS last month</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Instructors</h5>
                            <h4> {{ $instructorsCount }}</h4>
                        </div>
                    </div>
                    <p><b style="color: {{ $percentageChangeOfCourse >= 0 ? 'green' : 'red' }}">{{
                            $percentageChangeOfInstructor >= 0 ? '+' . $percentageChangeOfInstructor :
                            $percentageChangeOfInstructor }}%</b>
                        VS last month</p>

                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Course</h5>
                            <h4> {{ $courseCount }}</h4>
                        </div>
                    </div>
                    <p> <b style="color: {{ $percentageChangeOfCourse >= 0 ? 'green' : 'red' }}">{{
                            $percentageChangeOfCourse >= 0 ? '+' . $percentageChangeOfCourse : $percentageChangeOfCourse
                            }}%</b>
                        VS last month</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                
                <div class="total-client-box">
                    <div class="media">
                        <div class="media-body">
                            <h5>Earnings</h5>
                            <h4>€ {{ $totalEarnings }} </h4>
                        </div>
                    </div>

                    <p> <b style="color: {{ $earningParcentage >= 0 ? 'green' : 'red' }}">{{ $earningParcentage >= 0 ?
                            '+' . $earningParcentage : $earningParcentage }}%</b>
                        VS last month</p>
                    <img src="{{ asset('latest/assets/images/chart.svg') }}" alt="Chart" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/chart-d.svg') }}" alt="Chart" class="img-fluid dark-ele">
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 mt-15"> 
                <div class="earnings-chart-wrap">
                    <div class="row align-items-start">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center">
                                <h5>Revenue</h5>
                            </div>
                        </div>
                    </div>
                    <div id="timeSpendingChart"></div>
                </div>
            </div>
            <div class="col-xl-4 mt-15">
                <div class="top-performing-course">
                    <div class="d-flex">
                        <h5>Top Performing Courses</h5>
                        @if (count($TopPerformingCourses) > 5)
                        <a href="{{ url('admin/top-perform/courses') }}">View All</a>
                        @endif
                    </div>
                    <div class="course-lists ms-0 mt-2">
                        @if (count($TopPerformingCourses))
                        @php
                        $sale_count = $TopPerformingCourses[0]->sale_count;
                        $sn = 1;
                        @endphp
                        @foreach ($TopPerformingCourses->slice(0,5) as $course)
                        @php
                        if ($course->sale_count < $sale_count && $sn < 3) { $sale_count=$course->sale_count;
                            $sn++;
                            }
                            @endphp
                            <div class="media">
                                <img src="{{ asset($course->thumbnail) }}" alt="Avatar" class="img-fluid">
                                <div class="media-body">
                                    <h5><a href="{{ url('admin/courses', $course->slug) }}">{{ substr($course->title, 0, 20) . '...' }}</a></h5>
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
            <div class="col-xl-8 mt-15">
                <div class="course-status-wrap">
                    <div class="d-flex py-0 pe-0">
                        <h4>Course Status</h4>
                        <div class="d-flex">
                           @if (count($courses) > 5)
                           <a href="{{ url('admin/courses') }}" class="me-0">View All</a>
                           @endif 
                           
                            <div class="dropdown course-status-filter">
                                <button type="button" class="btn" data-bs-toggle="dropdown"
                                    aria-expanded="false">This month <i class="fas fa-angle-down"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">Three Months</a></li>
                                    <li><a class="dropdown-item" href="#">Six Months</a></li>
                                    <li><a class="dropdown-item" href="#">One Year</a></li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                    @if (count($courses) > 0)
                    <table>
                        <tr>
                            <th>Course Name</th>
                            <th>Price</th>
                            <th>Rating</th>
                            <th>Earning</th>
                            <th class="text-end">Sell</th>
                        </tr>
                        @foreach ($courses->slice(0,6) as $course)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{ asset($course->thumbnail) }}" alt="c-status" class="img-fluid">
                                    </div>
                                    <div class="media-body">
                                        <h5>{{ substr($course->title, 0, 35) }}</h5>
                                        <p> {{ $course->categories }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>{{ ($course->offer_price ? ($price = $course->offer_price) : ($price =
                                    $course->price)) ? '€' . $price : 'Free' }}
                                </p>
                            </td>
                            <td>
                                <p><i class="fas fa-star" style="color: #F8AA00;"></i>{{ number_format($course->avg_rating, 1) }}</p>
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
                    @else 
                        @include('partials/no-data')
                    @endif
                </div>
            </div>
            <div class="col-xl-4 mt-15">
                <div class="top-performing-course">
                    <div class="d-flex">
                        <h5>Message</h5>
                        @if (count($lastMessages) > 6)
                        <a href="#">View All</a>
                        @endif
                    </div>
                    <div class="messages-items-wrap">
                       @if (count($lastMessages) > 0)
                       @foreach ($lastMessages->slice(0,7) as $message)
                       <div class="messages-item">
                           <div class="media">
                               <div class="avatar">
                                   <img src="{{ asset( $message->user->avatar) }}" alt="Avatar" class="img-fluid">
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

{{-- time spend chart start --}}
<script>
    jQuery(document).ready(function() {
            var timeSpentData = @json($earningByMonth);
            var options = {
                series: [{
                    name: "Time spend",
                    data: timeSpentData, 
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
                    categories: ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'],
                }
            };
            var chart = new ApexCharts(document.querySelector("#timeSpendingChart"), options);
            chart.render();
        });
</script>
{{-- time spend chart end --}}
  
@endsection