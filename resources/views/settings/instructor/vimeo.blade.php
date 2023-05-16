@extends('layouts/instructor')
@section('title') Vimeo Settings Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/settings.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="profile-page-wrap">
    {{-- user profile header area @S --}}
    <div class="product-filter-wrapper my-0">
        <div class="product-filter-box mt-0 mb-4">
            <div class="password-change-txt">
                <h1 class="mb-1">Vimeo Settings</h1>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-12">
            <form action="">
                <div class="stripe-settings-form-wrap">
                    <div class="form-group">
                        <label for="">CLIENT ID</label>
                        <input type="text" class="form-control" placeholder="Enter Client ID" value="1234567890">
                    </div>
                    <div class="form-group mt-4">
                        <label for="">CLIENT SECRET</label>
                        <input type="text" class="form-control" placeholder="Enter Client Secret" value="0987654321">
                    </div>
                    <div class="form-submit">
                        <div class="go-to-stripe">
                            <a href="#" target="_blank"><i class="fa-brands fa-vimeo me-2"></i> Go to vimeo account <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="submit-form">
                            <button class="btn btn-submit" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    {{-- profile information @E --}}

</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}