@extends('layouts/instructor')
@section('title') Instructor Profile Details Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="profile-page-wrap">
    {{-- user profile header area @S --}}
    <div class="product-filter-wrapper my-0">
        <div class="product-filter-box mt-0">
            <div class="password-change-txt">
                <h1 class="mb-1">Instructor Profile</h1>
                <p>This is <span class="text-danger">{{$instructor->name}}</span> profile details.</p>
            </div>
            <div class="form-grp-btn mt-0 ms-auto">
                <a href="{{ url('admin/instructor') }}" class="btn me-3"><i class="fas fa-list"></i> All Instructor</a>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="change-password-form w-100 customer-profile-info">
                <div class="text-end">
                    <a href="{{url('admin/instructor/'.$instructor->id.'/edit')}}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div> 
                <div class="set-profile-picture">
                    <div class="media justify-content-center">
                        @if(isset($instructor->avatar))
                        <img src="{{ asset('assets/images/instructor/'.$instructor->avatar) }}" alt="{{$instructor->name}}" class="img-fluid">
                        @else
                        <span>{!! strtoupper($instructor->name[0]) !!}</span>
                        @endif 
                    </div>
                    <div class="role-label">
                        <span class="badge rounded-pill bg-dark">{{$instructor->user_role}}</span>
                    </div>
                </div>
                <div class="text-center">
                    <h3>{{$instructor->name}}</h3>
                    {{-- <span>{{$instructor->username ? '@'.$instructor->username : ''}}</span> --}}
                    <p>{{$instructor->short_bio}}</p>
                    <!-- details box @S -->
                    <div class="form-group mt-3 mb-1 ">
                        <label for="" class="mb-0"><i class="fa-solid fa-envelope"></i> Email: </label>
                        <p>{{$instructor->email}}</p>
                    </div>
                </div>
                <!-- details box @E -->
                <h6>Information :</h6>
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-flag"></i> Message Status: </label>
                    <p class="text-success">
                        @if($instructor->recivingMessage == 1)
                        <span class="badge text-bg-success"> Enabled </span>
                        @else
                        <span class="badge text-bg-danger"> Disabled </span>
                        @endif
                    </p>
                </div> 
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-phone"></i> Phone: </label>
                    <p>{{$instructor->phone ? $instructor->phone : 'N/A'}}</p>
                </div> 
                @php $social_links = explode(",",$instructor->social_links) @endphp
                @foreach($social_links as $key => $social_link)
                <div class="form-group my-0">
                    <label for="" class="mb-0"><i class="fas fa-link"></i>Social: </label>
                    <p>{{$social_link ? $social_link : 'N/A'}}</p>
                </div>
                @endforeach 
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="productss-list-box payment-history-table instructor-details-box mt-0 mb-4">
                        <h5>Details :</h5>
                        <p>{{$instructor->description ? $instructor->description : 'No Description Available'}}</p> 
                    </div>
                </div>  
            </div>
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