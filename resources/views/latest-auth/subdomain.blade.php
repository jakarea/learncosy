@extends('layouts.latest.auth')

@section('title')
Verify Email
@endsection

@section('style')
<style>
    .custom-margin-top {
        padding-top: 8rem;
    }
</style>
@endsection

@section('content')

<!-- pricing plan page start -->
<section class="auth-part-secs custom-margin-top">
    <div class="container">
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
                        <h6>3</h6>
                        <p>Step 3</p>
                    </div>
                    <div class="step-item">
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
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <!-- login form start -->
                <div class="username-box-wrap custom-margins">
                    <a href="#" class="mt-4">
                        <img src="{{asset('latest/assets/images/logo.svg')}}" alt="Logo" class="img-fluid">
                    </a>
                    <h1>Choose Subdomain</h1>
                    <p>Choose your subdomain.</p>
                    <form action="{{ route('instructor.username.update', Auth::user()->id) }}" method="POST" class="profile-form create-form-box ms-0 username-form"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="subdomain">Subdomain URL</label>
                        </div>
                        <div class="input-group">
                            @if (Auth::user()->username)
                            <input type="text" class="form-control @error('subdomain') is-invalid @enderror bg-light"
                                placeholder="write your subdomain" id="subdomain" name="username" aria-describedby="subdomain"
                                value="{{ old('username') ?? Auth::user()->username }}"
                                autocomplete="subdomain"
                                readonly
                                autofocus>
                            @else
                            <input type="text" class="form-control @error('subdomain') is-invalid @enderror"
                                placeholder="write your subdomain" id="subdomain" name="username" aria-describedby="subdomain"
                                value="{{ old('username') }}"
                                autocomplete="subdomain"
                                autofocus>
                                @error('username') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                            @endif
                            <span class="input-group-text bg-white" id="subdomain">.learncosy.com</span>
                        </div> 
                        <div class="form-group">
                            <span>Letter &amp; number only</span>
                        </div>
                        <div class="form-group">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-submit">
                            <button type="submit" class="btn btn-submit mx-auto">Save Changes</button>
                        </div>
                    </form>
                    <!-- Show validation error -->
                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <!-- login form end -->
            </div>
        </div>
    </div>
</section>
<!-- pricing plan page end -->
@endsection

@section('script')

@endsection