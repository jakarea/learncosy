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
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas facere nulla recusandae. Dolor quas ratione magnam, alias repellendus eaque nulla nisi dolore velit, soluta cumque!</p>

        <img src="{{asset('assets/images/desk-vector.jpg')}}" alt="desk-vector" class="img-fluid">
      </div>
    </div>
    <div class="col-lg-6">
        <div class="change-password-form change-password-form-2">
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
              <input type="password"  name="password" placeholder="*********" class="form-control @error('password') is-invalid @enderror" id="password">
              <span class="invalid-feedback">@error('password'){{ $message }} @enderror</span> 
              <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
            </div>
           <!-- input @E -->
           <!-- input @S -->
           <div class="form-group">
              <label for="">Confirm New Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password_confirmation" placeholder="*********" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
              <span class="invalid-feedback">@error('password_confirmation'){{ $message }} @enderror</span> 
              <i class="fa-regular fa-eye" onclick="changeType2()" id="eye-click2"></i>
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

@section('script')
<script>

  function changeType() {
    let field = document.getElementById("password");
    let clickk = document.getElementById("eye-click");

    if (field.type === "password") {
      field.type = "text";
      clickk.classList.add('fa-eye-slash');
      clickk.classList.remove('fa-eye');
    } else {
      field.type = "password";
      clickk.classList.remove('fa-eye-slash');
      clickk.classList.add('fa-eye');
    }

  }

  function changeType2() {
    let field = document.getElementById("password_confirmation");
    let clickk = document.getElementById("eye-click2");

    if (field.type === "password") {
      field.type = "text";
      clickk.classList.add('fa-eye-slash');
      clickk.classList.remove('fa-eye');
    } else {
      field.type = "password";
      clickk.classList.remove('fa-eye-slash');
      clickk.classList.add('fa-eye');
    }

  }
</script>
@endsection