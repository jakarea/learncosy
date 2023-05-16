@extends('layouts.auth')
@section('title','user password chnage')
@section('style') 
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />  
@endsection
@section('content')  
<!-- === user password chnage page @S === -->
<main class="user-password-chnage"> 
  <div class="container">
  <div class="row align-items-center">
    <div class="col-lg-6">
      <div class="password-change-txt">
        <h1>We're thrilled to have you on board!</h1>
        <p>we've generated an initial password for you. To ensure the safety of your account Please change it to be more secure. If you need assistance, our support team is always available to help.</p>

        <img src="{{asset('assets/images/desk-vector.jpg')}}" alt="desk-vector" class="img-fluid">
      </div>
    </div>
    <div class="col-lg-6">
        <div class="change-password-form">
          <h3> <span>{{ $user->name}}</span>, You are almost done!</h3>
          <p>Click the "Save Changes" button to update your password.</p>
          <!-- change pass form @S -->
          <form action="{{ route('postChangePassword',$user->id) }}" method="POST"> 
           @csrf
           <div class="form-group">
              <label for="">Email</label>
              <input type="text" placeholder="Email" class="form-control" value="{{ $user->email}}" disabled>
            </div>
           <!-- input @E -->
           <!-- input @S -->
           <div class="form-group">
              <label for="">New Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password" placeholder="*********" class="form-control @error('password') is-invalid @enderror" id="password">
              <span class="invalid-feedback">@error('password'){{ $message }} @enderror</span> 
            </div>
           <!-- input @E -->
           <!-- input @S -->
           <div class="form-group">
              <label for="">Confirm New Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password_confirmation" placeholder="*********" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
              <span class="invalid-feedback">@error('password_confirmation'){{ $message }} @enderror</span> 
            </div>
           <!-- input @E -->
           <!-- submit @S -->
           <div class="form-submit">
              <button class="btn btn-submit" type="submit">Save Changes</button>
            </div>
           <!-- submit @E -->
          </form>
          <!-- change pass form @E -->
        </div>
    </div>
  </div>
  </div>
</main>
<!-- === user password chnage page @E === -->
@endsection