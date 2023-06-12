@extends('layouts/instructor')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="">
    <div class="subscription-package col-12">
        @include('partials.session-message')
        <div class="header-title">
            @can('admin')
            <h2>Welcome, admin!</h2>
            @endcan
            @can('instructor')
            <h2>Welcome, instructor!</h2>
            @endcan
            @can('student')
            <h2>Welcome, Student!</h2>
            @endcan
        </div>

        <!-- Instructor Part -->
        @can('instructor')
        <section class="instructor-section">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Courses</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ totalCourseByInstructor(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Enrolled Student</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ totalEnrolledOfStudentByInstructor(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Earning</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ '$ ' . totalEarningByInstructor(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Expending</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ '$ ' . subscriptionCostByInstructor(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div id="teacher_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <div class="row justify-content-center">
            @foreach( getSubscriptionPackage() as $package )
            @php
            $package_featurelist = json_decode($package->features);
            @endphp 
            <div class="col-lg-5 col-xl-4 col-12 col-sm-9 col-md-6">
                <div class="price-package-box">
                    @if (isSubscribed($package->id))
                    <div class="current-package">
                        <span>Current Package</span>
                    </div>
                    @endif
                    <div class="package-title">
                        @if ($package->id == 1)
                        <h4><i class="fa-regular fa-star"></i> Lite </h4>
                        @elseif ($package->id == 2)
                        <h4><i class="fas fa-star"></i> Premium </h4>
                        @endif

                        @if ($package->id == 2)
                            <p>This is a large package</p>
                        @else
                            <p>This is a lite package</p>
                        @endif
                        
                    </div>
                    <div class="package-price">
                        <h3><span>€</span>{{ $package->amount }}<u> /per month</u></h3>
                        @if (!isSubscribed($package->id))
                        <a href="{{ route('instructor.subscription.create', $package->id) }}" class="will-subscribe">Get
                            started</a>
                        @else
                        <a href="#" class="subscribed">Subscribed</a>
                        @endif
                    </div>
                    <div class="package-features">
                        <h6>Features includes:</h6>
                        @if($package_featurelist)
                        <ul>
                            @foreach($package_featurelist as $feature)
                            <li><i class="fas fa-check"></i>
                                <p> {{ $feature }}</p>
                            </li>
                            @endforeach  
                        </ul>
                        @endif
                    </div>
                    {{-- <div class="package-ftr">
                        <a href="https://stripe.com/en-gb-us/payments/features">See all features</a>
                    </div> --}}
                </div>
            </div>
            @endforeach
        </div> -->
        @endcan
        <!-- Instructor Part -->

        @can('student')
        <!-- Student Part -->
        <section class="student-section">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Enrolled Courses</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ totalEnrolledByStudent(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Complete Lessons</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ totalCompleteLessonsByStudent(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Total Reviews</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ totalCompleteCourseReviewsByStudent(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 text-center">Total Paid</h6>
                        </div>
                        <div class="card-body text-center">
                            <h4>
                                {{ '$ ' . totalAmountPaidByStudent(auth()->user()->id) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div id="student_chart"></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Student Part -->
        @endcan
        
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@can('instructor')
<script>
    function TeacherChart()
    {
        var options = {
            series: [{
                name: 'Total Courses',
                data: [{{ totalCourseByInstructor(auth()->user()->id) }}]
            }, {
                name: 'Total Lessons',
                data: [{{ totalEnrolledOfStudentByInstructor(auth()->user()->id) }}]
            }, {
                name: 'Total Enrolled',
                data: [{{ totalEarningByInstructor(auth()->user()->id) }}]
            }, {
                name: 'Total Reviews',
                data: [{{ subscriptionCostByInstructor(auth()->user()->id) }}]
            }],
            chart: {
                height: 500,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '100%',
                    endingShape: 'rounded'
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
                categories: ['Total Courses', 'Total Lessons', 'Total Enrolled', 'Total Reviews'],
            },
            yaxis: {
                title: {
                    text: 'Total Instructor'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#teacher_chart"), options);
        chart.render();
    }
    TeacherChart();
</script>
@endcan

@can('student')
<script>
    function StudentChart() {
        var options = {
            series: [{
                name: 'Enrolled Courses',
                data: [{{ totalEnrolledByStudent(auth()->user()->id) }}]
            }, {
                name: 'Complete Lessons',
                data: [{{ totalCompleteLessonsByStudent(auth()->user()->id) }}]
            }, {
                name: 'Total Reviews',
                data: [{{ totalCompleteCourseReviewsByStudent(auth()->user()->id) }}]
            }, {
                name: 'Total Paid',
                data: [{{ totalAmountPaidByStudent(auth()->user()->id) }}]
            }],
            chart: {
                height: 500,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '100%',
                    endingShape: 'rounded'
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
                categories: ['Student Overview'],
            },
            yaxis: {
                title: {
                    text: 'Student Overview'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        };

        var student_chart = new ApexCharts(document.querySelector("#student_chart"), options);
        student_chart.render();
    }
    StudentChart();
</script>
@endcan
@endsection
{{-- page script @E --}}