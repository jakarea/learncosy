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
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-01.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Total Earnings</h5>
                    <h4>$40,832.00</h4>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-02.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Earnings Today</h5>
                    <h4>$120.00</h4>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="top-card-box">
                    <img src="{{asset('latest/assets/images/icons/ear-03.svg')}}" alt="ear-01" class="img-fluid">
                    <h5>Total Enrollments</h5>
                    <h4>120 Students</h4>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
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
            <div class="col-12 mt-3">
                <div class="package-list-header" style="grid-template-columns: 100%">
                    <h5>Payment Information:</h5> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap payment-table-admin">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Payment ID</th>
                            <th>Instructor Email</th> 
                            <th>Payment Amount</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Duration</th>
                        </tr>
                        @foreach ($payments as $key => $payment)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <h5>{{$payment->stripe_plan}}</h5>
                            </td>
                            <td>
                                <p>{{$payment->instructor->email}}</p>
                            </td> 
                            <td>
                                <p>{{$payment->amount}}</p>
                            </td> 
                            <td>
                                <p>{{$payment->start_at}}</p>
                            </td> 
                            <td>
                                <p>{{$payment->end_at}}</p>
                            </td> 
                            <td>
                                <p>{{$payment->trial_ends_at}}</p>
                            </td>  
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                {{ $payments->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== admin payment list page @E ==== --}}
@endsection
{{-- page content @E --}}