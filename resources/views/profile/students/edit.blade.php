@extends('layouts.latest.students')
@section('title') My Profile Management @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- student update page @S --}}
<main class="student-profile-update-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="own-profile-box">
                    <div class="header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">My Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Password</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            {{-- profile edit form start --}}
                            <form action="{{ route('students.profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row custom-padding">
                                    <div class="col-xl-3 col-lg-4">
                                        <div class="profile-picture-box">
                                            <input type="file" id="avatar" class="d-none" name="avatar">
                                            <label for="avatar" class="img-upload">
                                                <img src="{{asset('latest/assets/images/icons/camera-plus-w.svg')}}"
                                                    alt="a" class="img-fluid">
                                                <p>Update photo</p>
                                                <div class="ol">
                                                    @if ($user->avatar)
                                                    <img id="avatar-preview" src="{{asset('assets/images/users/'.$user->avatar)}}"
                                                        alt="Avatar" class="img-fluid static-image">
                                                    @else
                                                    <span class="avatar-box">{!! strtoupper($user->name[0]) !!}</span>
                                                    @endif
                                                </div>
                                            </label>

                                            <h6>Allowed *.jpeg, *.jpg, *.png, *.gif <br>
                                                Max size of 3.1 MB</h6>

                                            <div class="form-check form-switch ps-0">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Receiving
                                                    Messages</label>
                                                <input class="form-check-input" type="checkbox" name="recivingMessage"
                                                    role="switch" id="flexSwitchCheckChecked"
                                                    value="{{ $user->recivingMessage == 1 ? 'checked' : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8">
                                        <div class="profile-text-box">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="name" name="name" value="{{ $user->name }}">
                                                        <label for="name">Name</label>
                                                        <span class="invalid-feedback">@error('name'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="email" name="email" value="{{ $user->email }}">
                                                        <label for="email">Email</label>
                                                        <span class="invalid-feedback">@error('email'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="phone"
                                                            placeholder="phone" name="phone" value="{{ $user->phone }}">
                                                        <label for="phone">Phone Number</label>
                                                        <span class="invalid-feedback">@error('phone'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="social_links"
                                                            placeholder="social_links" name="social_links[]"
                                                            value="{{ $user->social_links }}">
                                                        <label for="social_links">Instagram</label>
                                                        <span class="invalid-feedback">@error('social_links'){{ $message
                                                            }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="short_bio"
                                                            placeholder="short_bio" name="short_bio"
                                                            value="{{ $user->short_bio }}">
                                                        <label for="short_bio">Bio</label>
                                                        <span class="invalid-feedback">@error('short_bio'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <textarea name="description" id="description"
                                                            class="form-control @error('description') is-invalid @enderror"
                                                            placeholder="About Yourself">{{ $user->description }}</textarea>

                                                        <label for="description">About</label>
                                                        <span class="invalid-feedback">@error('description'){{ $message
                                                            }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-submit-bttns">
                                                        <button type="submit" class="btn btn-submit">Save
                                                            Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- profile edit form end --}}
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab" tabindex="0">
                            {{-- password tab start --}}
                            <div class="row  user-add-form-wrap user-add-form-wrap-2">
                                <div class="col-12">
                                    <form action="{{ route('students.password.update',$user->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" placeholder="Email" class="form-control"
                                                        value="{{ $user->email}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">New Password<sup class="text-danger">*</sup></label>
                                                    <input type="password" name="password" placeholder="*********"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password">
                                                    <span class="invalid-feedback">@error('password'){{ $message }}
                                                        @enderror</span>
                                                    <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Confirm New Password<sup class="text-danger">*</sup></label>
                                                    <input type="password" name="password_confirmation" placeholder="*********"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation">
                                                    <span class="invalid-feedback">@error('password_confirmation'){{ $message }}
                                                        @enderror</span>
                                                    <i class="fa-regular fa-eye" onclick="changeType2()" id="eye-click2"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-submit-bttns">
                                                    <button type="submit" class="btn btn-submit">Save Changes</button>
                                                    <button type="reset" class="btn btn-cancel">Cancel</button>
                                                </div>
                                            </div>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                            {{-- password tab end --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- student update page @e --}}
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

  document.addEventListener("DOMContentLoaded", function() {
    const avatarInput = document.getElementById("avatar");
    const avatarPreview = document.getElementById("avatar-preview");

    avatarInput.addEventListener("change", function(event) {
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection

{{-- page script @E --}}