@extends('layouts/admin')
@section('title') Payment to Admin Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="profile-page-wrap">
    {{-- user profile header area @S --}}

    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row"> 
        <div class="col-lg-12">
            <div class="productss-list-box payment-history-table p-4">
                <h5 class="p-3 pb-3">Platfrom Fee </h5>
                <table class="table">
                    <thead>
                        <th width="5%">No</th>
                        <th>Payment ID</th>
                        <th>Instructor Email</th> 
                        <th>Payment Amount</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Duration</th>

                    </thead>
                </table>
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
    $(document).ready(function() {
        var table = $('table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.admin-payment') }}",
            columns: [
                // id and index
                {data: 'id', name: 'id'},
                {data: 'stripe_plan', name: 'payment_id'},
                {data: 'instructor_id', name: 'instructor_id'},
                {data: 'amount', name: 'amount'},
                {
                    data: 'start_at', 
                    name: 'start_at',
                    render: function(data, type, full, meta){
                        var date = new Date(data);
                        var month = date.toLocaleString('default', { month: 'long' });
                        var day = date.getDate();
                        var year = date.getFullYear();
                        return month + ' ' + day + ', ' + year;
                    }
                },
                {
                    data: 'end_at', 
                    name: 'end_at',
                    render: function(data, type, full, meta){
                        var date = new Date(data);
                        var month = date.toLocaleString('default', { month: 'long' });
                        var day = date.getDate();
                        var year = date.getFullYear();
                        return month + ' ' + day + ', ' + year;
                    }
                },
                // calculate start date to end date and show how many days left
                {
                    data: 'start_at', 
                    name: 'duration',
                    render: function(data, type, full, meta){
                        var date = new Date(data);
                        var month = date.toLocaleString('default', { month: 'long' });
                        var day = date.getDate();
                        var year = date.getFullYear();
                        var start_date = new Date(year, date.getMonth(), day);
                        var end_date = new Date(full.end_at);
                        var diff = Math.floor((end_date - start_date) / (1000 * 60 * 60 * 24));
                        return diff + ' days';
                    }
                },
            ]
        });
    });
</script>
@endsection
{{-- page script @E --}}