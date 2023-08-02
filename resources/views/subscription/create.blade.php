@extends('layouts.latest.admin')
@section('title') Add New Package @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === package add page @S === -->
<main class="subscription-add-page">
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
                <div class="package-list-header package-header-2">
                    <h5>Add New Package</h5> 
                    <div class="bttn text-end">
                        <a href="{{ route('admin.subscription') }}" class="common-bttn">Add Package</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-package-form">
                    <form action="{{route('admin.subscription.store')}}" method="POST" class="create-form-box">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-error">
                                    <label for="name">Name <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" placeholder="Enter name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" id="name">
                                    <span class="invalid-feedback">@error('name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-error">
                                    <label for="amount">Regular Price <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="number" placeholder="Enter Amount" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" id="price">
                                    <span class="invalid-feedback">@error('price'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-error">
                                    <label for="type">Subscription Type <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="type" id="type"
                                        class="form-control @error('type') is-invalid @enderror">
                                        <option value="">Select Subscription Type</option>
                                        <option value="monthly" {{ old('type') == 'monthly' ? 'selected' : '' }}>
                                            Monthly</option>
                                        <option value="yearly" {{ old('type') == 'yearly' ? 'selected' : '' }}>
                                            Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-error">
                                    <label for="status">Subscription Status <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="">Select Subscription Status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="feature_list" class="mb-1">Feature Available </label>

                                    <input type="text" placeholder="Add Feature" name="feature_list[]"
                                        class="form-control @error('feature_list') is-invalid @enderror"
                                        id="feature_list" multiple value="">

                                    <div class="feature-extra-field">
                                    </div>

                                    <span class="invalid-feedback">@error('feature_list'){{ $message }}
                                        @enderror</span>
                                    <div class="text-end mt-3">
                                        <a href="javascript:void(0)" id="feature_increment"><i class="fas fa-plus"></i> Add</a>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-submit-bttns">
                                    <button type="reset" class="btn btn-cancel">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</main>
<!-- === package add page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="{{asset('assets/js/file-upload.js')}}"></script>
<script>
    // JavaScript
    const urlBttn = document.querySelector('#feature_increment');
    let extraFields = document.querySelector('.feature-extra-field'); 

    const createField = () => { 
    let div = document.createElement("div");
    let node = document.createElement("input"); 
    node.setAttribute("class", "form-control @error('feature_list') is-invalid @enderror");
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

    const removeField = (field) => {
    // Remove the input field from the form
    field.remove();
    }

    urlBttn.addEventListener('click', createField, true);

</script>
@endsection

{{-- page script @E --}}