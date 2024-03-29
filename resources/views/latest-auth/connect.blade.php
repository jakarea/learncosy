@extends('layouts.latest.auth')

@section('title')
Vimeo Connect
@endsection

@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
<style>
    .custom-margin-top {
        padding-top: 4rem !important;
    }
</style>
@endsection

@section('content') 
<!-- pricing plan page start -->
<section class="auth-part-secs custom-margin-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="back-bttn w-100 mt-0">
                    <a href="{{ url('instructor/profile/step-3/complete') }}">Back</a>
                    {{-- @if(isVimeoConnected(auth()->user()->id)[1] == 'Connected' && isConnectedWithStripe()[1] == 'Connected') --}}
                    <a href="/instructor/profile/step-5/complete">Do it later</a>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {{-- verify step start --}}
                <div class="verify-step-wrap">
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 1</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 2</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 3</p>
                    </div>
                    <div class="step-item active">
                        <h6>4</h6>
                        <p>Step 4</p>
                    </div>
                    <div class="step-item">
                        <h6>5</h6>
                        <p>Step 5</p>
                    </div>
                    <div class="step-item">
                        <h6>6</h6>
                        <p>Step 6</p>
                    </div>
                </div>
                {{-- verify step end --}}
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-7 col-lg-5 col-xl-4">
                <!-- login form start -->
                <div class="connect-link-wrap mx-auto">
                    <div class="connect-box">
                        <h6>Connect Vimeo <sup><small
                                    class="badge badge-success @if(isVimeoConnected(auth()->user()->id)[1] == 'Connected') bg-success @else bg-danger @endif">{{
                                    isVimeoConnected(auth()->user()->id)[1] }}</small></sup></h6>
                        <a href="#" class="bttn" data-bs-toggle="modal" data-bs-target="#connectModal">
                            <img src="{{asset('latest/assets/images/auth/vimeo.svg')}}" alt="Vimeo" class="img-fluid">
                        </a>
                    </div>
                    <div class="connect-box">
                        <h6>Connect Stripe <sup><small
                                    class="badge badge-success @if(isConnectedWithStripe()[1] == 'Connected') bg-success @else bg-danger @endif">{{
                                    isConnectedWithStripe()[1] }}</small></sup> </h6>
                        <a href="#" class="bttn bttn-2" data-bs-toggle="modal" data-bs-target="#StripeconnectModal"><i
                                class="fa-brands fa-stripe"></i></a>
                    </div>
                </div>
                <!-- login form end -->
            </div>
        </div>
    </div>
</section>
 
<div class="app-modals">
    <div class="connect-modal-box">
        <div class="modal fade" id="connectModal" tabindex="-1" role="dialog" aria-labelledby="connectModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custom-modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="connectModalLabel">Connect Vimeo</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal"><i class="fas fa-close"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="connect-modal-wrap">
                            <form action="{{ route('instructor.vimeo.update',['subdomain' => config('app.subdomain')]) }}" method="POST">
                                @csrf
                                <div class="stripe-settings-form-wrap">
                                    <div class="form-group">
                                        <label for="client_id">CLIENT ID
                                            <sup><small
                                                    class="badge badge-success @if(isVimeoConnected(auth()->user()->id)[1] == 'Connected') bg-success @else bg-danger @endif">{{
                                                    isVimeoConnected(auth()->user()->id)[1] }}</small></sup>
                                        </label>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="Enter Client ID"
                                            name="client_id" value="{{ isVimeoConnected(auth()->user()->id)[0]->client_id ?? '' }}">
                                        <span class="text-danger">@error('client_id') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="client_secret">CLIENT SECRET</label>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="Enter Client Secret"
                                            name="client_secret" value="{{ isVimeoConnected(auth()->user()->id)[0]->client_secret ?? '' }}">
                                        <span class="text-danger">@error('client_secret') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="access_key">CLIENT ACCESS KEY</label>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="Enter Access Key"
                                            name="access_key" value="{{ isVimeoConnected(auth()->user()->id)[0]->access_key ?? '' }}">
                                        <span class="text-danger">@error('access_key') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="form-submit  mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="app-modals">
    <div class="connect-modal-box"> 
        <div class="modal fade" id="StripeconnectModal" tabindex="-1" role="dialog" aria-labelledby="StripeconnectModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custom-modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="connectModalLabel">Connect Stripe</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal"><i class="fas fa-close"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="connect-modal-wrap">
                            <form action="{{ route('instructor.stripe.update',['subdomain' => config('app.subdomain')]) }}" method="post">
                                @csrf
                                <div class="stripe-settings-form-wrap">
                                    <div class="form-group mb-3">
                                        <label for="stripe_public_key">STRIPE KEY
                                            <sup><small
                                                    class="badge badge-success @if(isConnectedWithStripe()[1] == 'Connected') bg-success @else bg-danger @endif">{{
                                                    isConnectedWithStripe()[1] }}</small></sup>
                                        </label>
                                        <input autocomplete="off" type="text" class="form-control" name="stripe_public_key"
                                            placeholder="Enter Secret Key" value="{{ Auth::user()->stripe_public_key }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="stripe_secret_key">STRIPE SECRET KEY</label>
                                        <input autocomplete="off" type="text" class="form-control" name="stripe_secret_key"
                                            placeholder="Enter Secret Key" value="{{ Auth::user()->stripe_secret_key }}">
                                    </div>
                                    <div class="form-submit">
                                        <div class="go-to-stripe">
                                            <a href="https://stripe.com" target="_blank"><i
                                                    class="fa-brands fa-cc-stripe me-2"></i>Go to stripe account <i
                                                    class="fas fa-arrow-right"></i></a>
                                        </div>
                                        <div class="submit-form mt-3">
                                            <button class="btn btn-primary w-100" type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script') 
{{-- dark mode js --}}
<script>
    const htmlBodyTag = document.querySelector("body"); 
    // Set localStorage with the value from the session
    localStorage.setItem('dark-mode', '{{ session('preferenceMode') }}');
    const storedModeNow = localStorage.getItem('dark-mode');
    console.log(storedModeNow);

    if (storedModeNow === 'dark-mode') {
        htmlBodyTag.classList.add('dark-mode');
    }
 
</script>
@endsection 