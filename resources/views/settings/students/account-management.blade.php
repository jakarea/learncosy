@extends('layouts/instructor')
@section('title') Account Management Page @endsection

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
        <div class="product-filter-box mb-4">
            <div class="password-change-txt">
                <h1 class="mb-1">Account Management</h1> 
            </div> 
        </div>
    </div>
   {{-- user profile header area @E --}}

   {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-4 col-md-5">
            <div class="change-password-form w-100 customer-profile-info">
                <div class="text-end">
                    <a href="{{url('students/profile/edit')}}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div>
                <div class="set-profile-picture">
                    <div class="media justify-content-center"> 
                        @if($user->avatar)
                        <img src="{{ asset('assets/images/students/'.$user->avatar) }}" alt="{{$user->name}}" class="img-fluid">
                        @else
                        <span>{!! strtoupper($user->name[0]) !!}</span>
                        @endif 
                    </div>
                    <div class="role-label">
                        <span class="badge rounded-pill bg-dark">{{$user->user_role}}</span>
                    </div>
                </div>
                <div class="text-center">
                    <h3>User profile and settings</h3> 
                </div> 
            </div>
        </div>
        <div class="col-lg-8 col-md-7">
            <div class="productss-list-box payment-history-table">
                <h5 class="p-3 pb-0">Payment and billing information :</h5> 
                <table>
                    <tr>
                        <th width="5%">No</th>
                        <th>Payment ID</th> 
                        <th>Card No</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr> 
                    
                   {{-- item @S --}} 
                    <tr>
                        <td>1</td> 
                        <td>23456</td> 
                        <td>12345674321</td>
                        <td>
                            <span class="badge text-bg-success">Success</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr> 
                   {{-- item @E --}}
                    
                   {{-- item @S --}} 
                    <tr>
                        <td>1</td> 
                        <td>23456</td> 
                        <td>12345674321</td>
                        <td>
                            <span class="badge text-bg-warning">Pending</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr> 
                   {{-- item @E --}}
                    
                   {{-- item @S --}} 
                    <tr>
                        <td>1</td> 
                        <td>23456</td> 
                        <td>12345674321</td>
                        <td>
                            <span class="badge text-bg-danger">Cancel</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
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
                </div>  --}}
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