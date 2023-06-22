@extends('layouts/admin')
@section('title') Package List Page @endsection

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
{{-- ==== Package list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Package filter area @S --}}
    <div class="product-filter-wrapper mt-0">
        
        <form action="" method="GET">
            <div class="product-filter-box mt-0">
                <h5>Package List</h5> 

                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ route('admin.subscription.create') }}" class="btn me-3"><i
                            class="fas fa-plus text-white me-2"></i>Add Package</a>
                </div>

            </div>
        </form>

    </div>
    {{-- Package filter area @E --}}

    {{-- Package listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box p-4">
                <table id="myDataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>  
                            <th width="16%" class="text-center">Amount</th> 
                            <th width="18%" class="text-center">Type</th> 
                            <th width="18%" class="text-center">Features</th>
                            <th width="8%" class="text-center">Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- Package listing @E --}}

</main>
{{-- ==== Package list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.subscription.data.table') }}",
            columns: [
                {data: 'name', name: 'name'},  
                {data: 'amount', name: 'amount'}, 
                {data: 'type', name: 'type'}, 
                {data: 'features', name: 'features'},
                {data: 'status', name: 'status', orderable:false, searchable: false},  
                {data: 'action', name: 'action', orderable:false, searchable: false}
            ]
        });
    });
</script>

@endsection
{{-- page script @E --}}

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        //delete_data on click confirm button then delete
        $(document).on('click', '.delete_data', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');

            // Send confirmation alert
            if (window.confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: "{{ route('admin.subscription.destroy', ':id') }}".replace(':id', id),
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#myDataTable').DataTable().ajax.reload();
                            window.location.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            } else {
                alert("You've clicked Cancel");
            }
        });

    });
</script>