@extends('layouts/dashboard')
@section('title')Contacts @endsection

{{-- page style @S --}}
@section('style')
<link rel="stylesheet" href="{{asset('dashboard-assets/css/contacts.css')}}">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('contents')
<!-- contacts page wrapper @s -->
<section class="common-page-wrap contacts-page-wrap">
    <!-- contacts head wrap @s -->
    <div class="row">
        <div class="col-lg-4 col-sm-7">
            <div class="search-box">
                <input type="text" placeholder="Search here..." class="form-control">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div class="col-lg-8 col-sm-5">
            <div class="contacts-grid-view-bttn">
                <a href="#" class="common-bttn"><i class="fas fa-plus"></i> New Contact</a>
                <ul>
                    <li><a href="#" class="active"><i class="fa-solid fa-bars"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-table-cells-large"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- contacts head wrap @e -->

    <!-- contact main box @s -->
    <div class="row">
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle not-active"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle not-active"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle not-active"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle not-active"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle not-active"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle not-active"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="col-lg-4 col-sm-6 col-md-4 col-xxl-3">
            <div class="contact-box">
                <div class="media">
                    <div class="avatar">
                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="media-body">
                        <h5>James Press</h5>
                        <p>@jamespress</p>
                        <a href="#">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- item @e -->
    </div>
    <!-- contact main box @e -->

    <!-- contacts paggination @s -->
    <div class="contacts-pagination-box">
        <p>Showing 10 from 160 data</p>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i> Previous</a></li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next <i class="fas fa-angle-right"></i></a></li>
            </ul>
        </nav>

    </div>
    <!-- contacts paggination @e -->

</section>
<!-- contacts page wrapper @e -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="{{asset('dashboard-assets/js/config.js')}}"></script>
@endsection
{{-- page script @E --}}