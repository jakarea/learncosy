@extends('layouts.latest.admin')
@section('title')
    Edit Package
@endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/subscription.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
    <!-- === package edit page @S === -->
    <main class="subscription-edit-page">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="package-list-header package-header-2">
                        <h5>Edit Package</h5>
                        <div class="bttn text-end">
                            <a href="{{ route('admin.subscription') }}" class="common-bttn">All Package</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="subscription-package-form">
                        <form action="{{ route('admin.subscription.update', $package->id) }}" method="POST"
                            class="create-form-box">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-error">
                                        <label for="name">Name  
                                        </label>
                                        <input type="text" placeholder="Enter student name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $package->name) }}" id="name">
                                        <span class="invalid-feedback">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-error">
                                        <label for="regular_price">Regular Price 
                                        </label>
                                        <input type="number" placeholder="Enter regular price" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $package->amount) }}" id="price">
                                        <span class="invalid-feedback">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-error">
                                        <label for="amount">Sales Price 
                                        </label>
                                        <input type="number" placeholder="Enter Amount" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $package->amount) }}" id="price">
                                        <span class="invalid-feedback">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-error form-selecting">
                                        <label for="type">Subscription Type 
                                        </label>
                                        <select name="type" id="type"
                                            class="form-control @error('type') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="monthly" {{ $package->type == 'monthly' ? 'selected' : '' }}>
                                                Monthly</option>
                                            <option value="yearly" {{ $package->type == 'yearly' ? 'selected' : '' }}>
                                                Yearly</option>
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-error form-selecting">
                                        <label for="status">Subscription Status 
                                        </label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="active" {{ $package->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ $package->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="feature_list" class="mb-1">Available Features </label>

                                        @php  $features = explode(',',$package->features) @endphp
                                        <div class="feature-extra-field">
                                            @foreach ($features as $feature)
                                                <div class="mb-2">
                                                    <input class="form-control" multiple="" type="text"
                                                        placeholder="Add Feature" name="feature_list[]"
                                                        value="{{ $feature }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <span class="invalid-feedback">
                                            @error('feature_list')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <div class="text-end mt-3">
                                            <a href="javascript:void(0)" id="feature_increment"><i class="fas fa-plus"></i>
                                                Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-submit-bttns">
                                        <button type="reset" class="btn btn-cancel">Cancel</button>
                                        <button type="submit" class="btn btn-submit">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- === package edit page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        const urlBttn = document.querySelector('#feature_increment');
        let extraFields = document.querySelector('.feature-extra-field');

        const createField = () => {
            let div = document.createElement("div");
            let node = document.createElement("input");
            node.setAttribute("class",
                "form-control @error('feature_list') is-invalid @enderror"
                );
            node.setAttribute("multiple", "");
            node.setAttribute("type", "text");
            node.setAttribute("placeholder", "Add Feature");
            node.setAttribute("name", "feature_list[]");

            let link = document.createElement("a");
            link.innerHTML = "<i class='fas fa-minus'></i>";
            link.addEventListener("click", () => removeField(div));

            div.appendChild(node);
            div.appendChild(link);

            extraFields.appendChild(div);
        }

        const removeField = (element) => {
            extraFields.removeChild(element);
        }

        urlBttn.addEventListener('click', createField, true);

        // Show the minus icon for the existing input fields in the loop
        const existingInputs = document.querySelectorAll('.feature-extra-field input');
        for (const input of existingInputs) {
            let div = document.createElement("div");
            div.appendChild(input);

            let link = document.createElement("a");
            link.innerHTML = "<i class='fas fa-minus'></i>";
            link.addEventListener("click", () => removeField(div));

            div.appendChild(link);

            extraFields.appendChild(div);
        }
    </script>
@endsection

{{-- page script @E --}}
