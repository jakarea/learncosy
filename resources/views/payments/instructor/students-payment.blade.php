@extends('layouts.latest.instructor')
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
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-01.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Total Earnings</h5>
                    <h4>$40,832.00</h4>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-02.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Earnings Today</h5>
                    <h4>$120.00</h4>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-03.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Total Enrollments</h5>
                    <h4>120 Students</h4>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-03.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Enrolled Today</h5>
                    <h4>10 Students</h4>
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
            <div class="col-12 mt-15">
                <div class="package-list-header" style="grid-template-columns: 100%">
                    <h5>Payment Information:</h5> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap earning-table">
                    <table>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Payment Type</th>
                            <th width="15%">Student Name</th>
                            <th>Course Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
    
                        </tr>
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->course->title }}</td>
                            <td>€ {{ $payment->amount }}</td>
                            <td>
                                @if ($payment->status == 'completed')
                                   <span style="color: #2A920B;">{{ $payment->status }}</span>
                                @else 
                                    <span style="color: #ED5763; background: transparent;">{{ $payment->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn-view">View</a>
                            </td>
                        </tr>
                        @endforeach 
                    </table>
                </div>
            </div>
        </div> 
    </div>
</main>
{{-- ==== admin payment list page @E ==== --}}
@endsection
{{-- page content @E --}}