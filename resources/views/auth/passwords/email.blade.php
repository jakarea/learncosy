@extends('layouts.auth')

@section('title')
Password Email
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-7">
                <div class="login-form-wrap" style="max-width: 450px">
                    <h1>Reset Password</h1>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input type="email" placeholder="Enter Email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-bttn mt-4">
                            <button type="submit" class="btn btn-submit"> {{ __('Send Password Reset Link') }}</button>
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