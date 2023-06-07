@extends('layouts/instructor')
@section('title') User password chnage @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === password update page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
              <div class="change-password-form change-password-form-2 mt-4">
                <h3> <span>Update </span> your password!</h3>
                <p>Click the "Save Changes" button to update your password.</p>
                <!-- change pass form @S -->
                <form action="{{ route('instructor.password.update',$user->id) }}" method="POST"> 
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
<!-- === password update page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
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

{{-- page script @E --}}