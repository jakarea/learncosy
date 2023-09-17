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
            @include('partials.session-message')
            <form action="{{ route('instructor.vimeo.update') }}" method="POST">
                @csrf
                <div class="stripe-settings-form-wrap">
                    <div class="form-group">
                        <label for="client_id">CLIENT ID
                            <sup><small class="badge badge-success @if(isVimeoConnected()[1] == 'Connected') bg-success @else bg-danger @endif">{{ isVimeoConnected()[1] }}</small></sup>
                        </label>
                        <input type="text" class="form-control" placeholder="Enter Client ID" name="client_id" value="{{ isVimeoConnected()[0]->client_id ?? '' }}">
                        <span class="text-danger">@error('client_id') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-4">
                        <label for="client_secret">CLIENT SECRET</label>
                        <input type="text" class="form-control" placeholder="Enter Client Secret" name="client_secret" value="{{ isVimeoConnected()[0]->client_secret ?? '' }}">
                        <span class="text-danger">@error('client_secret') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-4">
                        <label for="access_key">CLIENT ACCESS KEY</label>
                        <input type="text" class="form-control" placeholder="Enter Access Key" name="access_key" value="{{ isVimeoConnected()[0]->access_key ?? '' }}">
                        <span class="text-danger">@error('access_key') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-submit">
                        <div class="go-to-stripe">
                            <a href="https://vimeo.com" target="_blank"><i class="fa-brands fa-vimeo me-2"></i> Go to vimeo account <i class="fas fa-arrow-right"></i></a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('form').submit(function() {
            $('.btn-submit').attr('disabled', true);
            $('.btn-submit').html('<i class="fa fa-spinner fa-spin"></i> Updating...');
        });
    });
</script>
@endsection
{{-- page script @E --}}