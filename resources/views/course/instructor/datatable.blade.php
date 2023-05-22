@extends('layouts/instructor')
@section('title') Course List Page @endsection

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
{{-- ==== course list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- course filter area @S --}}
    <div class="product-filter-wrapper">
        
        <form action="" method="GET">
            <div class="product-filter-box">
                <h5>Course List</h5> 

                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('instructor/courses/create') }}" class="btn me-3"><i
                            class="fas fa-pen text-white me-2"></i>Create Course</a>
                </div>

            </div>
        </form>

    </div>
    {{-- course filter area @E --}}

    {{-- course listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box p-4">
                <table id="courseTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th width="10%" class="text-center">Thumbnail</th>
                            <th>Total Modules</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- course listing @E --}}

</main>
{{-- ==== course list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#courseTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('courses.data.table') }}",
            columns: [
                {data: 'title', name: 'title'},
                {data: 'image', name: 'image', orderable:false, searchable: false},
                {data: 'number_of_module', name: 'number_of_module'},
                {data: 'price', name: 'price'},
                {data: 'status', name: 'status', orderable:false, searchable: false},  
                {data: 'action', name: 'action', orderable:false, searchable: false}
            ]
        });
    });
</script>

@endsection
{{-- page script @E --}}