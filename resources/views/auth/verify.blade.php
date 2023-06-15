@extends('layouts.auth')

@section('title')
Verify Email
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="login-form-wrap">
            <h1>Verify Your Email Address</h1> 

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif
                {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                  
                <div class="form-bttn">
                    <button type="submit" class="btn btn-submit"> {{ __('click here to
                        request another') }}</button>
                </div>
                </form> 
            </div>
        </div>
    </div>
</div>
</section>
<!-- ====== login page content end ====== -->
@endsection

@section('script')
 
@endsection