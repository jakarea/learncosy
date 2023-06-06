@extends('layouts/instructor')
@section('title') Subscription Edit @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Student add page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session-message')
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Package Edit</h6>
                        <a href="{{ route('admin.subscription') }}">
                            <i class="fa-solid fa-user-group"></i> All Package </a>
                    </div>
                    <!-- Student Add form @S -->
                    <form action="{{route('admin.subscription.store')}}" method="POST" class="create-form-box">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="name">Name <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter student name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $package->name) }}" id="name">
                                            <span class="invalid-feedback">@error('name'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="amount">Amount <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="number" placeholder="Enter Amount" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price', $package->amount) }}" id="price">
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
                                                <option value="monthly" {{ $package->type == 'monthly' ? 'selected' : '' }}>
                                                    Monthly</option>
                                                <option value="yearly" {{ $package->type == 'yearly' ? 'selected' : '' }}>
                                                    Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-error">
                                            <label for="status">Subscription Status <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Subscription Status</option>
                                                <option value="active" {{ $package->status == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive" {{ $package->status == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="feature_list">Feature Available </label>
                                            <!-- <input type="text" placeholder="Add Feature" name="feature_list[]"
                                                class="form-control @error('feature_list') is-invalid @enderror"
                                                id="feature_list" multiple> -->
                                            @php
                                            $feature_list = json_decode($package->features);
                                            @endphp
                                            <div class="url-extra-field">
                                                @foreach($feature_list as $feature)
                                                <div class="url-extra-field">
                                                    <input type="text" placeholder="Add Feature" name="feature_list[]"
                                                        class="form-control @error('feature_list') is-invalid @enderror"
                                                        id="feature_list" value="{{ $feature }}">
                                                    <!-- first one no need minus -->
                                                    @if($loop->index != 0)
                                                    <a href="javascript:void(0)" class="url_remove"><i
                                                            class="fas fa-minus"></i></a>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="url-extra-field">
                                            </div>
                                            <span class="invalid-feedback">@error('feature_list'){{ $message }}
                                                @enderror</span>
                                            <a href="javascript:void(0)" id="url_increment"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                        </div>
                                    </div>
                                </div> <!-- row end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="submit-bttns">
                                    <button type="reset" class="btn btn-reset">Clear</button>
                                    <button type="submit" class="btn btn-submit">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Student add form @E -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- === Student add page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="{{asset('assets/js/file-upload.js')}}"></script>
<script>
    const urlBttn = document.querySelector('#url_increment');
    let extraFileds = document.querySelector('.url-extra-field'); 
    const createFiled = () => { 
      let div = document.createElement("div");
      let node = document.createElement("input"); 
      node.setAttribute("class", "form-control @error('feature_list') is-invalid @enderror");
      node.setAttribute("multiple", ""); 
      node.setAttribute("type", "text"); 
      node.setAttribute("placeholder", "Add Feature"); 
      node.setAttribute("name", "feature_list[]");    
      let linkk = document.createElement("a");
      linkk.innerHTML = "<i class='fas fa-minus'></i>";
      linkk.setAttribute("onclick", "this.parentElement.style.display = 'none';");
      let divNew = extraFileds.appendChild(div);
      divNew.appendChild(node);
      divNew.appendChild(linkk);
    }
  
    urlBttn.addEventListener('click',createFiled,true);
  
   
</script>
@endsection

{{-- page script @E --}}