@extends('layouts/instructor')
@section('title','Dashboard')
{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/chart/styles.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- === Instructor add page @S === -->
<main class="d-flex">
    
    <div class="col-12">
        <div class="row">
            <div class="col-md-3">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <div class="row">
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
            <div class="row mt-5 mb-4">
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