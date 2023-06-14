@extends('layouts/instructor')
@section('title','Dashboard')
{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/chart/styles.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/chart.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- === Instructor add page @S === -->
<main class="instructor-chart-page-wrap">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="top-date-box">
                    <div id="reportrange" class="date-box">
                        <i class="fa fa-calendar"></i> 
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row sparkboxes mt-4 mb-4">
            <div class="col-md-4">
                <div class="box box1">
                    <div id="spark1"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box2">
                    <div id="spark2"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box3">
                    <div id="spark3"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="stat-card course-card">
                    <div class="media">
                        <div class="media-body">
                            <h4>Total Course</h4>
                            <h3>45</h3>
                        </div>
                        <i class="fa-solid fa-tv"></i>
                    </div> 
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="stat-card">
                    <div class="media">
                        <div class="media-body">
                            <h4>Total Student</h4>
                            <h3>34</h3> 
                        </div>
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="stat-card">
                    <div class="media">
                        <div class="media-body">
                            <h4>Total Earning</h4>
                            <h3>€ 534</h3> 
                        </div>
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                <div class="stat-card">
                    <div class="media">
                        <div class="media-body">
                            <h4>Total Expense</h4>
                            <h3> €104</h3>
                        </div>
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div id="bar"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div id="donut"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="dashboard-table">
                    <h5> Recent Enrolment</h5>
                    <table>
                        <tr>
                            <th>
                                Course title
                            </th>
                            <th>
                                Student name
                            </th>
                            <th>
                                Student email
                            </th>
                            <th>
                                Amount
                            </th>
                        </tr>
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                Jhon Doe
                            </td>
                            <td>
                                student@demomail.com
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr>
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                Jhon Doe
                            </td>
                            <td>
                                student@demomail.com
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr>
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                Jhon Doe
                            </td>
                            <td>
                                student@demomail.com
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr>
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                Jhon Doe
                            </td>
                            <td>
                                student@demomail.com
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr>
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                Jhon Doe
                            </td>
                            <td>
                                student@demomail.com
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="dashboard-table">
                    <h5>Course-wise summary</h5>
                    <table>
                        <tr>
                            <th>
                                Course title
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Student
                            </th>
                            <th>
                                Earning
                            </th>
                        </tr>
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                € 533
                            </td>
                            <td>
                               Jhon Doe
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr> 
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                € 533
                            </td>
                            <td>
                               Jhon Doe
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr> 
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                € 533
                            </td>
                            <td>
                               Jhon Doe
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr> 
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                € 533
                            </td>
                            <td>
                               Jhon Doe
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr> 
                        <tr>
                            <td>Test Course title demo</td>
                            <td>
                                € 533
                            </td>
                            <td>
                               Jhon Doe
                            </td>
                            <td>
                                € 1234
                            </td>
                        </tr> 
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{ asset('assets/js/chart/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/chart/data.js') }}"></script>
<script src="{{ asset('assets/js/chart/script.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            $.ajax({
                url: '/your-route',
                type: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    // Handle the response from the backend
                    console.log(response);
                }
            });
        })
    });
</script>

@endsection