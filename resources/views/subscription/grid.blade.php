@extends('layouts.latest.admin')
@section('title') All Subscription List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== subscription list page @S ==== --}}
<main class="subscription-list-page">
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
                <div class="package-list-header">
                    <h5>Package List</h5>
                    <div class="form-group">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search package" class="form-control">
                    </div>
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="bttn">
                        <a href="{{ route('admin.subscription.create') }}" class="common-bttn"><i class="fas fa-plus"></i> Add Package</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap">
                    <table>
                        <tr>
                            <th>
                                Package name
                            </th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Features</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                         @foreach ($subscription_packages as $package) 
                        <tr>
                            <td>
                                <h5>{{$package->name}}</h5>
                            </td>
                            <td>
                                <p>€ {{$package->amount}}</p>
                            </td>
                            <td>
                                <p>{{$package->type}}</p>
                            </td>
                            <td>
                                @php  $features = json_decode($package->features); @endphp
                                @foreach ($features as $feature)
                                    <p>{{$feature}}</p> 
                                @endforeach
                               
                            </td>
                            <td>
                                @php 
                                    $status = $package->status == 'active' ? 'Active' : 'Inactive';
                                    $status_class = $package->status == 'active' ? 'success' : 'danger';
                                @endphp 
                                <span class="{{ $status_class }}">{{ $status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.subscription.edit', $package->id) }}" class="me-r"><img src="{{ asset('latest/assets/images/icons/edit.svg') }}" alt="Icon" class="img-fluid"></a>
                                <a href="{{ route('admin.subscription.destroy', $package->id) }}" class="delete_data" data-id="{{ $package->id }}"><img src="{{ asset('latest/assets/images/icons/trash.svg') }}" alt="Icon" class="img-fluid"></a>
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
                {{ $subscription_packages->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== subscription list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
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
@endsection
{{-- page script @S --}}