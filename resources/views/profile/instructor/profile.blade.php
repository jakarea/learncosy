@extends('layouts/admin')
@section('title') Profile Details Page @endsection

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
                <h1 class="mb-1">My Profile</h1>
                <p>This is <span class="text-danger"> Nayan Akram </span> Profile page.</p>
            </div>
            <div class="form-grp-btn mt-0 ms-auto">
                <a href="{{ url('/') }}" class="btn me-3"><i class="fas fa-list"></i> Dashboard</a>
            </div>
        </div>
    </div>
   {{-- user profile header area @E --}}

   {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="change-password-form w-100 customer-profile-info">
                <div class="text-end">
                    <a href="{{url('instructors/profile/nayan-akram/edit')}}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div>
                <div class="set-profile-picture">
                    <div class="media justify-content-center"> 
                        {{-- <img src="{{ asset('assets/images/') }}" alt="Name" class="img-fluid">  --}}
                        <span>N</span> 
                    </div>
                    <div class="role-label">
                        <span class="badge rounded-pill bg-dark">Instructor</span>
                    </div>
                </div>
                <div class="text-center">
                    <h3>Nayan Akram </h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, eum?</p>
                    <!-- details box @S -->
                    <div class="form-group mt-3 mb-1 ">
                        <label for="" class="mb-0"><i class="fa-solid fa-envelope"></i> Email: </label>
                        <p>nayan@mailinator.com</p>
                    </div> 
                </div>
                <!-- details box @E -->
                <h6>Information :</h6>  
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-flag"></i> Message Status: </label> 
                    <p class="text-success"><span class="badge text-bg-success">Enabled</span></p>  
                </div>
                <div class="form-group mb-0">
                    <label for="" class="mb-0"><i class="fa-solid fa-phone"></i> Phone: </label>
                    <p>+88 001 000 0000</p>
                </div>
                <div class="form-group my-0">
                    <label for="" class="mb-0"><i class="fa-brands fa-facebook"></i>Facebook: </label>
                    <p>facebook.com/nayan-arakm</p>
                </div>
                <div class="form-group my-0">
                    <label for="" class="mb-0"><i class="fa-brands fa-instagram"></i>Instagram: </label>
                    <p>instagram.com/nayan-arakm</p>
                </div>  
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="productss-list-box payment-history-table">
                        <h5 class="p-3 pb-0">Emails from students :</h5> 
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
                <div class="col-12">
                    <div class="productss-list-box payment-history-table instructor-details-box">
                        <h5>Instructor Details :</h5> 
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis non quos accusamus ut dicta, suscipit quia deserunt. Unde repellat a suscipit doloribus facere minima sapiente est rerum earum, </p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis non quos accusamus ut dicta, suscipit quia deserunt. Unde repellat a suscipit doloribus facere minima sapiente est rerum earum, libero aperiam pariatur. Explicabo, ratione repudiandae! Animi quia tempora nulla reprehenderit amet quam veniam? Maxime, sunt? Possimus debitis aliquam itaque provident. Tempore quas cum quasi sunt ad fugit mollitia suscipit aut impedit!</p>
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