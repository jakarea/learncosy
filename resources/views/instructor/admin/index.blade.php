@extends('layouts/instructor')
@section('title') Instructor List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Instructor list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Instructor filter area @S --}}
    <div class="product-filter-wrapper mt-0">
        
        <form action="" method="GET">
            <div class="product-filter-box mt-0">
                <h5>Instructor List</h5>  
                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('admin/instructor/create') }}" class="btn me-3"><i
                            class="fas fa-plus text-white me-2"></i>Add Instructor</a>
                </div> 
            </div>
        </form>

    </div>
    {{-- Instructor filter area @E --}}

    {{-- Instructor listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box p-4">
                <table id="myDataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">Avatar</th>
                            <th class="text-center">Name</th>  
                            <th width="16%" class="text-center">Email</th> 
                            <th width="18%" class="text-center">Phone</th> 
                            <th width="8%" class="text-center">Message Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- Instructor listing @E --}}

</main>
{{-- ==== Instructor list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('instructor.data.table') }}",
            columns: [
                {data: 'image', name: 'image', orderable:false, searchable: false},
                {data: 'name', name: 'name'},  
                {data: 'email', name: 'email'}, 
                {data: 'phone', name: 'phone'}, 
                {data: 'status', name: 'status', orderable:false, searchable: false},  
                {data: 'action', name: 'action', orderable:false, searchable: false}
            ]
        });
    });
</script>

@endsection
{{-- page script @E --}}