@extends('layouts.latest.admin')
@section('title')
    Subscription Packages
@endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/subscription.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
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
                    <form action="" method="GET" id="myForm">
                        <div class="package-list-header">
                            <h5>Package List</h5>
                            <div class="form-group">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search Package" class="form-control" name="name"
                                    value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}">
                            </div>
                            <input type="hidden" name="status" id="inputField">
                            <div class="filter-dropdown-box">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        id="dropdownBttn">
                                        All
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item filterItem" href="#">All</a></li>
                                        <li><a class="dropdown-item filterItem" href="#"
                                                data-value="active">Active</a></li>
                                        <li><a class="dropdown-item filterItem" href="#"
                                                data-value="inactive">Inactive</a></li>
                                    </ul>
                                </div>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="bttn">
                                <a href="{{ route('admin.subscription.create') }}" class="common-bttn"><i
                                        class="fas fa-plus"></i> Add Package</a>
                            </div>
                        </div>
                    </form>
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
                                        <h5>{{ $package->name }}</h5>
                                    </td>
                                    <td>
                                        <p>€ {{ $package->amount }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $package->type }}</p>
                                    </td>
                                    <td>
                                        @php
                                            //$features = explode(',', $package->features);
                                        @endphp
                                        {{ $package }}

                                    </td>
                                    <td>
                                        @php
                                            $status = $package->status == 'active' ? 'Active' : 'Inactive';
                                            $status_class = $package->status == 'active' ? 'success' : 'danger';
                                        @endphp
                                        <span class="{{ $status_class }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.subscription.edit', $package->id) }}" class="me-r"><img
                                                src="{{ asset('latest/assets/images/icons/edit.svg') }}" alt="Icon"
                                                class="img-fluid"></a>

                                        <form method="post" class="d-inline ps-0"
                                            action="{{ route('admin.subscription.destroy', $package->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><img
                                                    src="{{ asset('latest/assets/images/icons/trash.svg') }}"
                                                    alt="Icon" class="img-fluid"></button>
                                        </form>

                                        {{-- <a href="{{ route('admin.subscription.destroy', $package->id) }}"><img src="{{ asset('latest/assets/images/icons/trash.svg') }}" alt="Icon" class="img-fluid"></a> --}}
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let inputField = document.getElementById("inputField");
            let dropbtn = document.getElementById("dropdownBttn");
            let form = document.getElementById("myForm");
            let queryString = window.location.search;
            let urlParams = new URLSearchParams(queryString);
            let name = urlParams.get('name');
            let status = urlParams.get('status');
            let dropdownItems = document.querySelectorAll(".filterItem");

            if (status == "active") {
                dropbtn.innerText = 'Active';
            }
            if (status == "inactive") {
                dropbtn.innerText = 'Inactive';
            }
            inputField.value = status;

            dropdownItems.forEach(item => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    inputField.value = this.getAttribute("data-value");
                    dropbtn.innerText = item.innerText;
                    form.submit();
                });
            });
        });
    </script>
@endsection
{{-- page script @S --}}
