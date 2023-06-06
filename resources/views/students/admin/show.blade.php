@extends('layouts/instructor')
@section('title') Student Profile Details Page @endsection

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
                <h1 class="mb-1">Student Profile</h1>
                <p>This is <span class="text-danger">{{$student->name}}</span> profile details.</p>
            </div>
            <div class="form-grp-btn mt-0 ms-auto">
                <a href="{{ url('admin/students') }}" class="btn me-3"><i class="fas fa-list"></i> All Students</a>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="change-password-form w-100 customer-profile-info">
                <div class="text-end">
                    <a href="{{url('instructor/students/'.$student->id.'/edit')}}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div> 
                <div class="set-profile-picture">
                    <div class="media justify-content-center">
                        @if(isset($student->avatar))
                        <img src="{{ asset('assets/images/students/'.$student->avatar) }}" alt="{{$student->name}}" class="img-fluid">
                        @else
                        <span>{!! strtoupper($student->name[0]) !!}</span>
                        @endif 
                    </div>
                    <div class="role-label">
                        <span class="badge rounded-pill bg-dark">{{$student->user_role}}</span>
                    </div>
                </div>
                <div class="text-center">
                    <h3>{{$student->name}}</h3>
                    
                    <p>{{ Str::limit($student->short_bio, $limit = 65, $end = '...') }}</p>
                    <!-- details box @S -->
                    <div class="form-group mt-3 mb-1 ">
                        <label for="" class="mb-0"><i class="fa-solid fa-envelope"></i> Email: </label>
                        <p>{{$student->email}}</p>
                    </div>
                </div>
                <!-- details box @E -->
                <h6>Information :</h6>
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-flag"></i> Message Status: </label>
                    <p class="text-success">
                        @if($student->recivingMessage == 1)
                        <span class="badge text-bg-success"> Enabled </span>
                        @else
                        <span class="badge text-bg-danger"> Disabled </span>
                        @endif
                    </p>
                </div> 
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-phone"></i> Phone: </label>
                    <p>{{$student->phone ? $student->phone : 'N/A'}}</p>
                </div> 
                @php $social_links = explode(",",$student->social_links) @endphp
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
                        {!! $instructor->description !!}
                    </div>
                </div> 
                <div class="col-12">
                    <div class="productss-list-box payment-history-table mt-4">
                        <h5 class="p-3 pb-0">Enrolled Course List :</h5>
                        <table>
                            <tr>
                                <th width="5%">No</th>
                                <th>Course Name</th>
                                <th>Course Review</th>
                                <th>Course Progress</th>
                                <th>View Course</th>

                            </tr>
                            {{-- item @S --}}
                            <tr>
                                <td>1</td>
                                <td>React Redux</td>
                                <td>345</td>
                                <td>50%</td>
                                <td>
                                    <a href="#"><i class="fas fa-eye text-dark"></i></a>
                                </td>
                            </tr>
                            {{-- item @E --}}
                            {{-- item @S --}}
                            <tr>
                                <td>2</td>
                                <td>React Redux</td>
                                <td>345</td>
                                <td>40%</td>
                                <td>
                                    <a href="#"><i class="fas fa-eye text-dark"></i></a>
                                </td>
                            </tr>
                            {{-- item @E --}}
                        </table>
                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="payment-method-info-item">
                                    <span class="text-mute">Card Brand</span>
                                    <h6 class="text-success">No Payment Method</h6>
                                </div>
                            </div>
                        </div> --}}
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