@extends('layouts/instructor')
@section('title') Profile Details Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="profile-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- user profile header area @S --}}
    <div class="product-filter-wrapper my-0">
        <div class="product-filter-box mt-0">
            <div class="password-change-txt">
                <h1 class="mb-1">My Profile</h1>
                <p><span class="text-danger">Update</span> profile info to see more details.</p>
            </div>
            <div class="form-grp-btn mt-0 ms-auto">
                <a href="{{ url('instructor/profile/change-password') }}" class="btn me-3"><i class="fas fa-key"></i> Change Password</a>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="change-password-form w-100 customer-profile-info">
                <div class="text-end">
                    <a href="{{url('instructor/profile/edit')}}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div>
                <div class="set-profile-picture">
                    <div class="media justify-content-center">
                        @if($user->avatar)
                        <img src="{{ asset('assets/images/instructor/'.$user->avatar) }}" alt="{{$user->name}}" class="img-fluid">
                        @else
                        <span>{!! strtoupper($user->name[0]) !!}</span>
                        @endif 
                    </div>
                    <div class="role-label">
                        <span class="badge rounded-pill bg-dark">{{$user->user_role}}</span>
                    </div>
                </div>
                <div class="text-center">
                    <h3>{{$user->name}}</h3>
                    <p>{{ Str::limit($user->short_bio, $limit = 65, $end = '...') }}</p>
                    <!-- details box @S -->
                    <div class="form-group mt-3 mb-1 ">
                        <label for="" class="mb-0"><i class="fa-solid fa-envelope"></i> Email: </label>
                        <p>{{$user->email}}</p>
                    </div>
                </div>
                <!-- details box @E -->
                <h6>Information :</h6>
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-flag"></i> Message Status: </label>
                    <p class="text-success">
                        @if($user->recivingMessage == 1)
                        <span class="badge text-bg-success"> Enabled </span>
                        @else
                        <span class="badge text-bg-danger"> Disabled </span>
                        @endif
                    </p>
                </div> 
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-phone"></i> Phone: </label>
                    <p>{{$user->phone ? $user->phone : '--'}}</p>
                </div> 
                @php $social_links = explode(",",$user->social_links) @endphp
                @foreach($social_links as $key => $social_link)
                <div class="form-group my-0">
                    <label for="" class="mb-0"><i class="fas fa-link"></i>Social: </label>
                    <p>{{$social_link ? $social_link : '--'}}</p>
                </div>
                @endforeach 
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="productss-list-box payment-history-table instructor-details-box mt-0 mb-4">
                        <h5>Details :</h5>
                        {!! $user->description !!} 
                    </div>
                </div>
                <div class="col-12">
                    <div class="productss-list-box payment-history-table">
                        <h5 class="p-3 pb-0">Message from students:</h5>
                        <table>
                            <tr>
                                <th width="5%">No</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>View</th>

                            </tr>
                            {{-- item @S --}}
                            <tr>
                                <td>1</td>
                                <td>Jhon Doe</td>
                                <td>doe@yopmail.com</td>
                                <td>All</td>
                                <td>
                                    <span class="badge text-bg-danger">Unread</span>
                                </td>
                                <td>
                                    <a href="#"><i class="fas fa-eye text-dark"></i></a>
                                </td>
                            </tr>
                            {{-- item @E --}}
                            {{-- item @S --}}
                            <tr>
                                <td>1</td>
                                <td>Nayan Akram</td>
                                <td>nayan@yopmail.com</td>
                                <td>English</td>
                                <td>
                                    <span class="badge text-bg-success">Read</span>
                                </td>
                                <td>
                                    <a href="#"><i class="fas fa-eye text-dark"></i></a>
                                </td>
                            </tr>
                            {{-- item @E --}}
                        </table> 
                    </div>
                </div>
                <div class="col-12">
                    <div class="productss-list-box payment-history-table mt-4">
                        <h5 class="p-3 pb-0">My Course List :</h5>
                        @if (count($courses) > 0) 
                        <table>
                            <tr>
                                <th width="5%">No</th>
                                <th>Course Name</th>
                                <th>Price</th>
                                <th>Short Description</th>
                                <th>View Course</th>

                            </tr>
                            @foreach ($courses as $key=> $course)
                                {{-- item @S --}}
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$course->title}}</td>
                                    <td>{{$course->price}}</td>
                                    <td>{{ $course->short_description}}</td>
                                    <td>
                                        <a href="{{url('instructor/courses/'.$course->slug)}}"><i class="fas fa-eye text-dark"></i></a>
                                    </td>
                                </tr>
                                {{-- item @E --}}
                            @endforeach 
                        </table>
                        @else
                        <div class="text-center pb-4">
                            <p class="text-danger">No Course Found!</p>
                        </div>
                        @endif
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