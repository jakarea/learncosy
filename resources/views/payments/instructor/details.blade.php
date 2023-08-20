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
            <div class="col-12">
                <div class="payment-details-title">
                    <h1>Payment Details</h1>
                </div>
            </div>
         </div>  
         <div class="row">
            <div class="col-lg-9">
                <div class="payment-name-box">
                    <div>
                        <h6>Payment by</h6>
                        <h5>Kelly Leannon</h5>
                    </div>
                    <div>
                        <h6>Subscription Date</h6>
                        <h5>5 Aug, 2023</h5>
                    </div>
                    <div>
                        <h6>Payment Date</h6>
                        <h5>5 Aug, 2023</h5>
                    </div>
                    <div>
                        <h6>Payment type</h6>
                        <h5>Stripe</h5>
                    </div>
                    <div>
                        <h6>Status</h6>
                       <span>Success</span>
                    </div>
                </div>
                <div class="pay-details-box-invoice">
                    <table>
                        <tr>
                            <th>Details</th>
                            <th>Course Type</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td>Figma UI UX Design Essentials Flash Course 2023</td>
                            <td>
                                Standard course
                            </td>
                            <td>$180.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">- 25% discount</td>
                            <td>$45.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Grand Total</td>
                            <td>$135.00</td>
                        </tr>
                    </table>
                    <div class="download-inv-box">
                        <a href="#">Back</a>
                        <a href="#"><img src="{{asset('latest/assets/images/icons/upload-3.svg')}}" alt="a" class="img-fluid"> Download Invoice</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="paid-student-name">
                    <div class="avatar">
                        <img src="{{asset('latest/assets/images/student-avatar.png')}}" alt="a" class="img-fluid">
                    </div>
                    <div class="txt">
                        <h5>Kelly Leannon</h5>
                        <h6>Student</h6>

                        <hr>

                        <ul>
                            <li><img src="{{asset('latest/assets/images/icons/p-1.svg')}}" alt="a" class="img-fluid"> kellyleannon@gemail.com</li>
                            <li><img src="{{asset('latest/assets/images/icons/p-2.svg')}}" alt="a" class="img-fluid"> +11 1234 567 890</li>
                            <li><img src="{{asset('latest/assets/images/icons/p-3.svg')}}" alt="a" class="img-fluid"> instagram.com/kellyleannon</li>
                        </ul>
                    </div>
                </div>
            </div>
         </div>
    </div>
</main>
{{-- ==== admin payment list page @E ==== --}}
@endsection
{{-- page content @E --}}