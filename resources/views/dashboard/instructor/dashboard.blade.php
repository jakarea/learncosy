@extends('layouts/instructor')
@section('title', 'Dashboard')
{{-- page style @S --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/dashboard.css') }}">
    <link href="{{ asset('dashboard-assets/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- dashboard page wrapper @s -->
    <main class="common-page-wrap dashboard-page-wrap">
        <!-- dashboard chart box @s -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
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
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                <!-- total clients @s -->
                <div class="card-box total-client-month mt-0">
                    <div class="media">
                        <div class="media-body">
                            {{-- {{ print_r($courses) }} --}}
                            <h4>{{ count($courses) }}</h4>
                            <h5>Course</h5>
                            <p></p>
                        </div>
                        <img src="{{ asset('assets/images/graph-8.svg') }}" alt="Chart" class="img-fluid">
                    </div>
                </div>
                <!-- total clients @e -->
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                <!-- total clients @s -->
                <div class="card-box total-client-month mt-0">
                    <div class="media">
                        <div class="media-body">
                            <h4>562</h4>
                            <h5>Total Earnings</h5>
                            <p></p>
                        </div>
                        <img src="{{ asset('assets/images/graph-7.svg') }}" alt="Chart" class="img-fluid">
                    </div>
                </div>
                <!-- total clients @e -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Statistics</h5>
                        <a href="#"><i class="fas fa-bars"></i></a>
                    </div>
                    <div id="chart"></div>
                </div>
                <!-- project statistic @e -->
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 col-xxl-4">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap pb-4">
                    <div class="statics-head mb-4">
                        <h5>Categories</h5>
                        <a href="#"><i class="fas fa-bars"></i></a>
                    </div>
                    <div id="categories"></div>
                </div>
                <!-- project statistic @e -->
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-22">
                <!-- project statistic @s -->
                <div class="card-box project-statistic-wrap">
                    <div class="statics-head">
                        <h5>Earnings</h5>
                        <a href="#"><i class="fas fa-bars"></i></a>
                    </div>
                    <div id="chart-timeline"></div>
                </div>
                <!-- project statistic @e -->
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
                        <a href="#"><i class="fas fa-bars"></i></a>
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
    <script>
        const data = @json($categories)
        console.log(data)
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('dashboard-assets/js/clients-projects-chart.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/multiple-chart.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/donut-chart.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/box-chart.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/line-chart.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/line-chart-2.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/config.js') }}"></script>
@endsection
