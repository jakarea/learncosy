@extends('layouts/instructor')
@section('title') Lesson List Page @endsection

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
{{-- ==== Lesson list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Lesson filter area @S --}}
    <div class="product-filter-wrapper mt-0">
        
        <form action="" method="GET">
            <div class="product-filter-box mt-0">
                <h5>Lesson List</h5> 

                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('instructor/lessons/create') }}" class="btn me-3"><i
                            class="fas fa-plus text-white me-2"></i>Create Lesson</a>
                </div>

            </div>
        </form>

    </div>
    {{-- Lesson filter area @E --}}

    {{-- Lesson listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box p-4">
                <table id="myDataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-start">Title</th> 
                            <th width="10%" class="text-center">Thumbnail</th>
                            <th width="19%" class="text-center">Video Link</th>  
                            <th width="8%" class="text-center">Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- Lesson listing @E --}}

</main>
{{-- ==== Lesson list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('lessons.data.table') }}",
            columns: [
                {data: 'title', name: 'title'},
                {data: 'image', name: 'image', orderable:false, searchable: false},
                {data: 'video_link', name: 'video_link'}, 
                {data: 'status', name: 'status', orderable:false, searchable: false},  
                {data: 'action', name: 'action', orderable:false, searchable: false}
            ]
        });
    });
</script>

@endsection
{{-- page script @E --}}