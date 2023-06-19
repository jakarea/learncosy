@extends('layouts/dashboard')
@section('title')Kanban @endsection

{{-- page style @S --}}
@section('style')
<link rel="stylesheet" href="{{asset('dashboard-assets/css/kanban.css')}}">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('contents')
<!-- kanban page wrapper @s -->
<section class="common-page-wrap kanban-page-wrap">
    <!-- kanban header banner @s -->
    <div class="card-box kanban-header-banner">
        <div class="row align-items-centers">
            <div class="col-lg-7">
                <div class="left-txt">
                    <h1>Codebytes Company Profile Websites</h1>
                    <h6>Created by <span>Hajime Mahmude</span> n on June 31, 2020</h6>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                        totam rem https://codebytes.peterdraw.com/UIDesignSample</p>

                    <div class="d-flex">
                        <h5>Total Progress 60%</h5>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="right-txt">
                    <div class="media">
                        <div class="media-body">
                            <h5>Codebytes Base</h5>
                            <h6>Software House</h6>
                        </div>
                        <img src="{{asset('dashboard-assets/images/c-logo.svg')}}" alt="Logo" class="img-fluid">
                        <a href="#">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                    </div>
                    <div class="bottom-bttns">
                        <div>
                            <a href="#" class="add-bttn"><i class="fa-solid fa-user-plus"></i> Invite People</a>
                            <a href="#" class="cmnt-bttn"><i class="fa-solid fa-comment-dots"></i> 45 Comments</a>
                        </div>
                        <ul>
                            <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar"
                                    class="img-fluid"></li>
                            <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar"
                                    class="img-fluid"></li>
                            <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar"
                                    class="img-fluid"></li>
                            <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar"
                                    class="img-fluid"></li>
                            <li><span>2+</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- kanban header banner @e -->

    <!-- kanban list wrapper @s -->
    <div class="kanban-list-box">
        <!-- item @s -->
        <div class="list-item">
            <div class="header">
                <h5>To-Do List (24)</h5>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="ylow"><i class="fas fa-circle"></i> Important</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Visual Graphic for Presentation to Client</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar ylow" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="grn"><i class="fas fa-circle"></i> Databse</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Setup database for create API connection</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar grn" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="d-red"><i class="fas fa-circle"></i> Design</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Create wireframe for landing page phase 1</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar d-red" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="list-item">
            <div class="header">
                <h5>On Progress (2)</h5>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="blu"><i class="fas fa-circle"></i> UPDATE</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Update information in footer section</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar blu" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="grn"><i class="fas fa-circle"></i> Databse</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Setup database for create API connection</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar grn" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="list-item">
            <div class="header">
                <h5>Done (3)</h5>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="blu"><i class="fas fa-circle"></i> UPDATE</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Update information in footer section</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar blu" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="grn"><i class="fas fa-circle"></i> Databse</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Setup database for create API connection</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar grn" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="list-item">
            <div class="header">
                <h5>Revised (0)</h5>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>
            <!-- todo box @s -->
            <div class="card-box empty-box">
                <div class="move-heare-box">
                    <p><img src="./assets/images/move-icon.svg" alt="Icon" class="img-fluid"> Move card here</p>
                </div>
            </div>
            <!-- todo box @e -->
        </div>
        <!-- item @e -->
        <!-- item @s -->
        <div class="list-item">
            <div class="header">
                <h5>Completed (2)</h5>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="blu"><i class="fas fa-circle"></i> UPDATE</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Update information in footer section</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar blu" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
            <!-- todo box @s -->
            <div class="card-box todo-box">
                <div class="d-flex">
                    <span class="grn"><i class="fas fa-circle"></i> Databse</span>
                    <a href="#"><i class="fas fa-ellipsis"></i></a>
                </div>
                <h6>Setup database for create API connection</h6>

                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar grn" style="width: 25%"></div>
                </div>

                <div class="todo-ftr">
                    <ul>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                        <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="a" class="img-fluid">
                        </li>
                    </ul>

                    <p><i class="fa-regular fa-clock"></i> Due in 4 days</p>
                </div>
            </div>
            <!-- todo box @e -->
        </div>
        <!-- item @e -->
    </div>
    <!-- kanban list wrapper @e -->
</section>
<!-- kanban page wrapper @e -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="{{asset('dashboard-assets/js/config.js')}}"></script>
@endsection
{{-- page script @E --}}