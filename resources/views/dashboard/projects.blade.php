@extends('layouts/dashboard')
@section('title')Projects @endsection

{{-- page style @S --}}
@section('style') 
<link rel="stylesheet" href="{{asset('dashboard-assets/css/projects.css')}}">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('contents')
 <!-- projects page wrapper @s -->
 <section class="common-page-wrap projects-page-wrap">
    <!-- projects tab head @s -->
    <div class="projects-tab-head-wrap">
      <div class="row">
        <div class="col-md-8 col-lg-7 col-xxl-6">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All Status</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">On Progress</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Pending</button>
            </li> 
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact2-tab" data-bs-toggle="pill" data-bs-target="#pills-contact2" type="button" role="tab" aria-controls="pills-contact2" aria-selected="false">Closed</button>
            </li> 
          </ul>
        </div>
        <div class="col-md-4 col-lg-5 col-xxl-6">
          <div class="project-grid-view-bttn">
            <a href="#" class="common-bttn"><i class="fas fa-plus"></i> New Project</a>
            <ul>
              <li><a href="#" class="active"><i class="fa-solid fa-bars"></i></a></li>
              <li><a href="#"><i class="fa-solid fa-table-cells-large"></i></a></li>
            </ul>
          </div>
        </div>
      </div> 
    </div>
    <!-- projects tab head @e -->

    <!-- projects tab body @s -->
    <div class="projects-tab-body-wrap">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
          <!-- all projects list view @s -->
          <div class="all-projects-boxs">
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress on">ON PROGRESS</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress pending">PENDING</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress closed">CLOSED</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress on">ON PROGRESS</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress pending">PENDING</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
          </div>
          <!-- all projects list view @e -->
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <!-- all onprogress @s -->
          <div class="all-projects-boxs">
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress on">ON PROGRESS</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress on">ON PROGRESS</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress on">ON PROGRESS</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress on">ON PROGRESS</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
          </div>
          <!-- all onprogress @e -->
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
          <!-- all pending @s -->
          <div class="all-projects-boxs">
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress pending">PENDING</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress pending">PENDING</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress pending">PENDING</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress pending">PENDING</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
          </div>
          <!-- all pending @e -->
        </div> 
        <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact2-tab" tabindex="0">
          <!-- all closed @s -->
          <div class="all-projects-boxs">
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress closed">CLOSED</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress closed">CLOSED</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress closed">CLOSED</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="project-item">
              <div>
                <h6>#P-000441425</h6>
                <h5>Create UseCase Diagram of Fillow..</h5>
                <p><i class="fas fa-calendar"></i> Created on Sep 8th, 2020</p>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Client</h6>
                  <h4>Tatiana Dias</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Person in charge</h6>
                  <h4>Davis Korsgaard</h4>
                </div>
              </div>
              <div class="media">
                <img src="{{asset('dashboard-assets/images/power-icon.svg')}}" alt="Avatar" class="img-fluid">
                <div class="media-body">
                  <h6>Deadline</h6>
                  <h4>Monday,  Sep 26th 2020</h4>
                </div>
              </div>
              <div class="actions">
                <a href="#" class="progress closed">CLOSED</a>
                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              </div> 
            </div>
            <!-- item @e -->
          </div>
          <!-- all closed @e -->
        </div> 
      </div>
    </div>
    <!-- projects tab body @e -->

    <!-- projects paggination @s -->
    <div class="projects-pagination-box">
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
    <!-- projects paggination @e -->
  </section>
  <!-- projects page wrapper @e -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script') 
<script src="{{asset('dashboard-assets/js/config.js')}}"></script>
@endsection
{{-- page script @E --}}