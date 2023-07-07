@extends('layouts/student')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<style>
    .student_summery_chart {
        margin-right: 40px;
    }
    .student_summery_content ul li {
        line-height: 30px;
    }
    .student_summery .student_summery_chart .chart {
        position:relative;
        width:120px;
        height:120px;
        margin: 0 auto;
    }
    .student_summery .student_summery_chart canvas {
        display: block;
        position:absolute;
        top:0;
        left:0;
    }
    .student_summery .student_summery_chart span {
        color:#555;
        display:block;
        line-height:120px;
        text-align:center;
        width:120px;
        font-size:30px;
        margin-left:5px;
    }
    </style>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="d-flex">
    <div class="col-12">
        <div class="row">
            <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                <h5 class="p-3 pb-0 my-course">My Courses</h5>
                <table class="my-tabl">
                    <tr>
                        <th width="5%"><i class="fa-solid fa-bars-staggered"></i> No</th>
                        <th><i class="fa-solid fa-book-open"></i> Course Name</th>
                        <th><i class="fa-solid fa-money-bill"></i> Paid</th>
                        <th><i class="fa-solid fa-calendar-day"></i> Start Date</th>
                        <th><i class="fa-solid fa-headset"></i> Support</a></th>
                       

                    </tr>
                    {{-- item @S --}}
                    @php 
                    $i = 0;
                    @endphp
                    @foreach($enrolments as $enrolment)
                    @php 
                    $i++
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td> <a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{ $enrolment->course->title}} </a> </td>
                        <td>{{ $enrolment->amount}}</td>
                        <td>{{ $enrolment->created_at->format('F j, Y')}}</td>
                        <td><a class="contact_bttn" href="{{ url('instructor1/course/messages/send',$enrolment->course->id)}}" target="_blank" rel="noopener noreferrer"> Contact </td>
                    </tr>
                    @endforeach
                    
                </table>
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="payment-method-info-item">
                            <span class="text-mute">Card Brand</span>
                            <h6 class="text-success">No Payment Method</h6>
                        </div>
                    </div>
                </div> --}}
            </div>
                <div class="row">
                    @if ( count(studentRadarChart(auth()->user()->id)['labels'] ) > 0 )
                    @foreach(studentRadarChart(auth()->user()->id)['labels'] as $key => $label)
                    <div class="col-4">
                        <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                            <h6 class="p-3 pb-0 my-course"> {{ \Str::limit($label, 20) }}</h6>
                            <div class="student_summery d-flex justify-content-between align-items-center">
                                <div class="student_summery_content p-3">
                                    <ul>
                                        <li><span><i class="fa-solid fa-thumbs-up text-primary"></i> Lesson</span> <span>{{ studentRadarChart(auth()->user()->id)['lesson'][$key] }}</span></li>
                                        <li><span><i class="fa-solid fa-thumbs-up text-primary"></i> Module</span> <span>{{ studentRadarChart(auth()->user()->id)['modules'][$key] }}</span></li>
                                        <li><span><i class="fa-solid fa-thumbs-up text-primary"></i> In Progress</span> <span>{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}</span></li>
                                    </ul>
                                </div>
                                <div class="student_summery_chart">
                                    <figure class="text-center">
                                        <div class="chart" id="graph{{ $key+1 }}" data-percent="{{ studentRadarChart(auth()->user()->id)['progress'][$key] }}" data-color="#4C60FF"></div>
                                        <!-- <figcaption><h3>Web design</h3></figcaption> -->
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-12">
                        <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                            <h6 class="p-3 pb-0 my-course"> No Course Found</h6>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function	(){

    var el;
    var options;
    var canvas;
    var span;
    var ctx;
    var radius;

    var createCanvasVariable = function(id){  // get canvas
        el = document.getElementById(id);
    };

    var createAllVariables = function(){
        options = {
            percent:  el.getAttribute('data-percent') || 25,
            size: el.getAttribute('data-size') || 120,
            lineWidth: el.getAttribute('data-line') || 10,
            rotate: el.getAttribute('data-rotate') || 0,
            color: el.getAttribute('data-color')
        };

        canvas = document.createElement('canvas');
        span = document.createElement('span');
        span.textContent = options.percent + '%';

        if (typeof(G_vmlCanvasManager) !== 'undefined') {
            G_vmlCanvasManager.initElement(canvas);
        }

        ctx = canvas.getContext('2d');
        canvas.width = canvas.height = options.size;

        el.appendChild(span);
        el.appendChild(canvas);

        ctx.translate(options.size / 2, options.size / 2); // change center
        ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

        radius = (options.size - options.lineWidth) / 2;
    };


    var drawCircle = function(color, lineWidth, percent) {
        percent = Math.min(Math.max(0, percent || 1), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = 'square'; // butt, round or square
        ctx.lineWidth = lineWidth;
        ctx.stroke();
    };

    var drawNewGraph = function(id){
        el = document.getElementById(id);
        createAllVariables();
        drawCircle('#efefef', options.lineWidth, 100 / 100);
        drawCircle(options.color, options.lineWidth, options.percent / 100);


    };
    // drawNewGraph('graph1');
    var graph = document.getElementsByClassName('chart');
    for (var i = 0; i < graph.length; i++) {
        drawNewGraph(graph[i].id);
    }

});

</script>
@endsection
{{-- page script @E --}}