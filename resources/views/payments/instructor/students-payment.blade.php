@extends('layouts.latest.instructor')
@section('title')
Payment From Student
@endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
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
                    <img src="{{ asset('latest/assets/images/icons/ear-01.svg') }}" alt="ear-01"
                        class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/icons/ear-01-d.svg') }}" alt="ear-01"
                        class="img-fluid dark-ele">
                    <h5>Total Earnings</h5>
                    <h4>€ {{ $totalEarnings }}</h4>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{ asset('latest/assets/images/icons/ear-02.svg') }}" alt="ear-01"
                        class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/icons/ear-02-d.svg') }}" alt="ear-01"
                        class="img-fluid dark-ele">
                    <h5>Earnings Today</h5>
                    <h4>€ {{ $todaysEarnings }}</h4>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{ asset('latest/assets/images/icons/ear-03.svg') }}" alt="ear-01"
                        class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/icons/ear-03-d.svg') }}" alt="ear-01"
                        class="img-fluid dark-ele">
                    <h5>Total Enrollments</h5>
                    <h4>{{ $totalEnrolment }} Students</h4>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="top-card-box">
                    <img src="{{ asset('latest/assets/images/icons/ear-03.svg') }}" alt="ear-01"
                        class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/icons/ear-03-d.svg') }}" alt="ear-01"
                        class="img-fluid dark-ele">
                    <h5>Enrolled Today</h5>
                    <h4>{{ $todaysEnrolment }} Students</h4>
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
        @if (count($payments) > 0)
        <div class="row">
            {{-- filter form --}}
            <form action="" method="GET" id="myForm">
                <input type="hidden" name="status" id="inputField">
            </form>
            {{-- filter form --}}
            <div class="col-12">
                <div class="subscription-table-wrap earning-table subs-table">
                    <table>
                        <tr>
                            <th width="3%">No</th>
                            <th class="d-flex justify-content-between">
                                <span>Course Name</span>
                                <div class="filter-sort-box">
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" id="dropdownBttn">
                                            <img src="{{ asset('latest/assets/images/icons/sort-icon.svg') }}" alt="a"
                                                class="img-fluid">
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item filterItem" href="#" data-value="asc">In order
                                                    A-Z</a></li>
                                            <li><a class="dropdown-item filterItem" href="#" data-value="desc">In order
                                                    Z-A</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </th>
                            <th width="12%">Student Name</th>
                            <th width="12%">Payment Date</th>
                            <th width="12%">Payment Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }} </td>
                            <td>{{ Str::limit($payment->course->title, $limit = 46, $end = '..') }}</td>
                            <td>{{ $payment->user->name }} </td>
                            <td>{{ $payment->created_at->format('d M Y') }} </td>
                            <td>{{ $payment->payment_method }} </td>
                            <td>€ {{ $payment->amount }}</td>
                            <td>
                                @if ($payment->status == 'completed')
                                <span style="color: #2A920B;">{{ $payment->status }}</span>
                                @else
                                <span style="color: #ED5763; background: transparent;">{{ $payment->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('instructor/payments', encrypt($payment->payment_id)) }}"
                                    class="btn-view">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-12">
                {{-- pagginate --}}
                <div class="paggination-wrap">
                    {{ $payments->links('pagination::bootstrap-5') }}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12">
                @include('partials/no-data')
            </div>
        </div>
        @endif
    </div>
</main>
{{-- ==== admin payment list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
            let inputField = document.getElementById("inputField");
            let form = document.getElementById("myForm");
            let dropdownItems = document.querySelectorAll(".filterItem");

            dropdownItems.forEach(item => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    inputField.value = this.getAttribute("data-value");
                    form.submit();
                });
            });
        });
</script>
@endsection
{{-- page script @E --}}