@extends('layouts.latest.students')
@section('title') Course Certificate @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== course activity list page @S ==== --}}
<main class="course-activity-list-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="package-list-header" style="grid-template-columns: 100%">
                    <h5>Certificate</h5>
                </div>
            </div>
        </div>
        @if (count($certificateCourses) > 0 ) 
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap activity-table">
                    <table>
                        <tr>
                            <th>Course Title</th>
                            <th>Duration</th>
                            <th>Total Point</th>
                            <th>Your Point</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($certificateCourses as $certificateCourse)
                        <tr>
                            <td>
                                <div class="media">
                                    <img src="{{ asset($certificateCourse->thumbnail) }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <h5><a href="{{url('students/courses/'.$certificateCourse->slug)}}">
                                            {{ Str::limit($certificateCourse->title, $limit = 45, $end = '..') }}
                                        </a></h5>
                                        <h6>{{ $certificateCourse->categories }}</h6>
                                    </div>
                                </div>
                            </td>

                            {{-- course lesson duration calculation --}}
                            @php
                            $totalDurationMinutes = 0;
                            @endphp
                            @foreach($certificateCourse->modules as $module)
                            @foreach($module->lessons as $lesson)
                            @php
                            $totalDurationMinutes += $lesson->duration;
                            @endphp
                            @endforeach
                            @endforeach
                            {{-- course lesson duration calculation --}}

                            <td>
                                <p>{{ number_format($totalDurationMinutes /60, 2) }} h
                                </p>
                            </td>
                            <td>
                                <p>1000</p>
                            </td>
                            <td>
                                <p>600</p>
                            </td>
                            @php
                            $totalPorgressPercent = StudentActitviesProgress(auth()->user()->id, $certificateCourse->id);  
                            $showPercentage = null; 
                            if($totalPorgressPercent > 92 && $totalPorgressPercent < 100){
                                $showPercentage = $totalPorgressPercent - 4;
                            }
                            @endphp
                            <td>
                                @if($totalPorgressPercent >= 100)
                                    <span>Completed</span>
                                @elseif($totalPorgressPercent < 1)
                                    <span class="danger">Not Started</span>
                                @elseif($totalPorgressPercent >= 0 && $totalPorgressPercent <= 99)
                                    <span>Inprogress</span>
                                @endif
                            </td>
                            <td>

                                <div class="circle-prog">
                                    <div class="cards">
                                        <div class="percent">
                                            <svg>
                                                <circle cx="27" cy="30" r="25"></circle>
                                                <circle cx="27" cy="30" r="25"
                                                    style="--percent: {{ $showPercentage ? $showPercentage : $totalPorgressPercent }}"></circle>
                                            </svg>
                                            @php
                                                $totalLessons = 0;
                                                $completedLessons = 0;
                                            @endphp
                                            @foreach ($certificateCourse->modules as $module)
                                                @php
                                                    $totalLessons += count($module->lessons);
                                                    $completedLessons += $module->lessons->where('completed', 1)->count();
                                                @endphp
                                            @endforeach
                                            <div class="number" style="left: 37%">
                                                <h6>{{ $totalPorgressPercent }}<b style="font-size: 14px">%</b></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($totalPorgressPercent > 99 && $totalPorgressPercent < 101)
                                <a href="{{url('students/courses-certificate/'.$certificateCourse->slug)}}">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                @else
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                @endif


                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="7">
                                <a href="{{url('students/certificate-download/laboriosam-quisquam-libero-nam-odio')}}" class="btn btn-primary">Test Download</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @else 
        <div class="row">
            <div class="col-12">
                @include('partials/no-data')
            </div>
        </div>
        @endif
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                {{ $certificateCourses->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== course activity list page @E ==== --}}
@endsection
{{-- page content @E --}}
