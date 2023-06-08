@extends('layouts/instructor')
@section('title') Payment from Students Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/settings.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="profile-page-wrap">
    {{-- user profile header area @S --}}
    <div class="product-filter-wrapper my-0">
        <div class="product-filter-box mt-0 mb-4">
            <div class="password-change-txt">
                <h1 class="mb-1">Payment from Students</h1>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row"> 
        <div class="col-lg-12">
            <div class="productss-list-box payment-history-table">
                <h5 class="p-3 pb-0">Payment Information :</h5>
                <table>
                    <tr>
                        <th width="5%">No</th>
                        <th>Payment Type</th>
                        <th>Student Name</th>
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
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">View</a>
                        </td>
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
        </div>
    </div>
    {{-- profile information @E --}}

</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script>
    // $(document).ready(function() {
    //     $('table').DataTable();
    // });
</script>
@endsection
{{-- page script @E --}}