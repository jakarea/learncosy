@extends('layouts.latest.admin')
@section('title') Payment From Student @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== admin payment list page @S ==== --}}
<main class="admin-payment-list-page">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-01.svg')}}" alt="ear-01" class="img-fluid light-ele">
                    <img src="{{asset('latest/assets/images/icons/ear-01-d.svg')}}" alt="ear-01" class="img-fluid dark-ele">
                    <h5>Total Earnings</h5> 

                    <span style="color: {{ $formattedPercentageChangeOfEarningByMonth < 0 ? 'red' : '' }}"> 
                        @if ($formattedPercentageChangeOfEarningByMonth < 0 )
                        <img src="{{asset('latest/assets/images/icons/down-red.svg')}}" alt="icon" class="img-fluid">
                        @else 
                        <img src="{{asset('latest/assets/images/icons/upgrade.svg')}}" alt="icon" class="img-fluid">
                        @endif
                        {{ number_format(floatval($formattedPercentageChangeOfEarningByMonth), 0, '.', '') }}%
                    </span>

                    <h4>${{$totalEnrollmentSell}}</h4>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-02.svg')}}" alt="ear-01" class="img-fluid light-ele">
                    <img src="{{asset('latest/assets/images/icons/ear-02-d.svg')}}" alt="ear-01" class="img-fluid dark-ele">
                    <h5>Earnings Today</h5>


                    <span style="color: {{ $formattedPercentageChangeOfEarningByDay < 0 ? 'red' : '' }}"> 
                        @if ($formattedPercentageChangeOfEarningByDay < 0 )
                        <img src="{{asset('latest/assets/images/icons/down-red.svg')}}" alt="icon" class="img-fluid">
                        @else 
                        <img src="{{asset('latest/assets/images/icons/upgrade.svg')}}" alt="icon" class="img-fluid">
                        @endif
                        {{ number_format(floatval($formattedPercentageChangeOfEarningByDay), 0, '.', '') }}%
                    </span> 

                    <h4>${{$todaysTotalEnrollmentSell}}</h4>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-03.svg')}}" alt="ear-01" class="img-fluid light-ele">
                    <img src="{{asset('latest/assets/images/icons/ear-03-d.svg')}}" alt="ear-01" class="img-fluid dark-ele">

                    <span style="color: {{ $formatedPercentageChangeOfStudentEnrollByMonth < 0 ? 'red' : '' }}"> 
                        @if ($formatedPercentageChangeOfStudentEnrollByMonth < 0 )
                        <img src="{{asset('latest/assets/images/icons/down-red.svg')}}" alt="icon" class="img-fluid">
                        @else 
                        <img src="{{asset('latest/assets/images/icons/upgrade.svg')}}" alt="icon" class="img-fluid">
                        @endif
                        {{ number_format(floatval($formatedPercentageChangeOfStudentEnrollByMonth), 0, '.', '') }}%
                    </span> 
 
                    <h5>Total Enrollments</h5>
                    <h4>{{$totalEnrollment}} Students</h4>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-03.svg')}}" alt="ear-01" class="img-fluid light-ele">
                    <img src="{{asset('latest/assets/images/icons/ear-03-d.svg')}}" alt="ear-01" class="img-fluid dark-ele">

                    <span style="color: {{ $formatedPercentageChangeOfStudentEnrollByDay < 0 ? 'red' : '' }}"> 
                        @if ($formatedPercentageChangeOfStudentEnrollByDay < 0 )
                        <img src="{{asset('latest/assets/images/icons/down-red.svg')}}" alt="icon" class="img-fluid">
                        @else 
                        <img src="{{asset('latest/assets/images/icons/upgrade.svg')}}" alt="icon" class="img-fluid">
                        @endif
                        {{ number_format(floatval($formatedPercentageChangeOfStudentEnrollByDay), 0, '.', '') }}%
                    </span> 
 
                    <h5>Enrolled Today</h5>
                    <h4>{{$todaysEnrollment}} Students</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="pay-title">
                    <h4>Payment from student</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="package-list-header" style="grid-template-columns: 100%">
                    <h5>Payment Information:</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap payment-table-admin">
                    @if (count($enrolments) > 0) 
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Course Name</th>
                            <th>Student Name</th>
                            <th>Payment Date</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($enrolments as $key => $payment)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <h5>{{(strlen($payment->course->title) > 50) ? substr($payment->course->title, 0, 47) . "..." : $payment->course->title }}</h5>
                            </td>
                            <td>
                                <p>{{$payment->user->name}}</p>
                            </td>
                            <td>
                                <p>{{ $payment->created_at->format('M j, Y') }}</p>
                            </td>
                            <td>
                                <p>{{$payment->payment_method}}</p>
                            </td>
                            <td>
                                <!-- <p>{{$payment->status}}</p> -->
                                <p>{{$payment->amount}}</p>
                            </td>
                            <td>
                                <p>{{$payment->status}}</p>
                            </td>
                            <td>
                                <ul>
                                    <a href="{{ route('export',encrypt($payment->payment_id)) }}" class="btn-view">Export</a>
                                    <a href="{{ route('view',encrypt($payment->payment_id)) }}" class="btn-view">View</a>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else 
                    @include('partials/no-data')
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== admin payment list page @E ==== --}}
@endsection
{{-- page content @E --}}
