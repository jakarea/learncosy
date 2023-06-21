@extends('layouts/instructor')
@section('title') Review List Page @endsection

{{-- page style @S --}}
@section('style')
<link rel="stylesheet" href="{{asset('dashboard-assets/css/messages.css')}}">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Review list page @S ==== --}}
<main class="product-research-page-wrap">
<section class="common-page-wrap messages-page-wrap">
    <!-- message box @s -->
    <div class="messages-box">
        <!-- person list @s -->
        <div class="chat-person-list-box">
            <div class="title">
                <h1>Inbox <span>(2,456)</span></h1>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <!-- all chat person @s -->
                    <div class="person-tab-body">       
                        <!-- person @e -->
                        <div class="d-flex">
                            <h6>RECENT MESSAGE</h6>
                            <a href="#">
                                <i class="fas fa-ellipsis-vertical"></i>
                            </a>
                        </div>
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Rayna Carder </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>I remember that project due is tomorrow.</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Skylar Dorwart </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Hei, dont forget to clear server cache!</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Kierra Curtis</h5>
                                    <span>2m ago</span>
                                </div>
                                <p>I dont't know where that files saved dude.</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Bella Siregar</h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Ok sir. I will fix it as soon as possible</p>
                            </div>
                        </div>
                        <!-- person @e -->
                    </div>
                    <!-- all chat person @e -->
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <!-- social chat person @s -->
                    <div class="person-tab-body">
                        <div class="d-flex">
                            <h6>SOCIAL</h6>
                        </div>
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/c-logo.svg')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Codebytes Sutudios </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Guys, remember for weekly meeting at 8PM tonight!</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/grid-icon.svg')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>World Designer </h5>
                                    <span>12m ago</span>
                                </div>
                                <p>I think you should put that component more lower th..</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <div class="d-flex">
                            <h6>RECENT MESSAGE</h6>
                            <a href="#">
                                <i class="fas fa-ellipsis-vertical"></i>
                            </a>
                        </div>
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Rayna Carder </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>I remember that project due is tomorrow.</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Skylar Dorwart </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Hei, dont forget to clear server cache!</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Kierra Curtis</h5>
                                    <span>2m ago</span>
                                </div>
                                <p>I dont't know where that files saved dude.</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Bella Siregar</h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Ok sir. I will fix it as soon as possible</p>
                            </div>
                        </div>
                        <!-- person @e -->
                    </div>
                    <!-- social chat person @e -->
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">
                    <!-- updates chat person @s -->
                    <div class="person-tab-body">
                        <div class="d-flex">
                            <h6>UPDATE</h6>
                        </div>
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/c-logo.svg')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Codebytes Sutudios </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Guys, remember for weekly meeting at 8PM tonight!</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/grid-icon.svg')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>World Designer </h5>
                                    <span>12m ago</span>
                                </div>
                                <p>I think you should put that component more lower th..</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <div class="d-flex">
                            <h6>RECENT MESSAGE</h6>
                            <a href="#">
                                <i class="fas fa-ellipsis-vertical"></i>
                            </a>
                        </div>
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Rayna Carder </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>I remember that project due is tomorrow.</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Skylar Dorwart </h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Hei, dont forget to clear server cache!</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Kierra Curtis</h5>
                                    <span>2m ago</span>
                                </div>
                                <p>I dont't know where that files saved dude.</p>
                            </div>
                        </div>
                        <!-- person @e -->
                        <!-- person @s -->
                        <div class="media">
                            <div class="avatar">
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="media-body">
                                <div class="name">
                                    <h5>Bella Siregar</h5>
                                    <span>2m ago</span>
                                </div>
                                <p>Ok sir. I will fix it as soon as possible</p>
                            </div>
                        </div>
                        <!-- person @e -->
                    </div>
                    <!-- updates chat person @e -->
                </div>
            </div>
            <!-- person tab body @e -->
        </div>
        <!-- person list @e -->
        <!-- chat-main-body box @s -->
        <div class="chat-main-body-box">
            <div class="chat-room-head">
                <!-- chat person -->
                <div class="media">
                    <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                    <div class="media-body">
                        <h5>Rayna Carder</h5>
                        <p>Last online at 04:45 AM</p>
                    </div>
                </div>
                <!-- chat person -->

                <!-- chat room head icons @s -->
                <div class="chat-room-head-icons">
                    <ul>
                        <li><a href="#"><i class="fas fa-video"></i></a></li>
                        <li><a href="#"><i class="fas fa-search"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-ellipsis-vertical"></i></a></li>
                    </ul>
                </div>
                <!-- chat room head icons @e -->
            </div>
            <!-- main chart room @s -->
            <div class="main-chat-room">
                <!-- chat date @s -->
                <div class="chat-top-date">
                    <span>Yesterday</span>
                </div>
                <!-- chat date @s -->
                <!-- messages @s -->
                <div class="chat-messages-box">
                    <!-- item @s -->
                    <div class="message-item reciver">
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto b</p>

                        <span>Wednesday, December 23th, 2020 at 4.30 AM</span>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item sender mb-1">
                        <p>sed quia consequuntur magni dolores</p>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item sender">
                        <p>nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in
                            ea</p>
                        <span>Wednesday, December 23th, 2020 at 4.30 AM</span>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item reciver mb-1">
                        <p>Remember that dude</p> 
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item reciver">
                        <p>Hey, check my design update last night. Tell me what you think and if that is OK</p> 
                        <span>Wednesday, December 23th, 2020 at 4.30 AM</span>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item sender mb-1">
                        <p>sed quia consequuntur magni dolores</p>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item sender">
                        <p>nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in
                            ea</p>
                        <span>Wednesday, December 23th, 2020 at 4.30 AM</span>
                    </div>
                    <!-- item @e --> 
                    <!-- item @s -->
                    <div class="message-item reciver mb-1">
                        <p>Remember that dude</p> 
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item reciver">
                        <p>Hey, check my design update last night. Tell me what you think and if that is OK</p> 
                        <span>Wednesday, December 23th, 2020 at 4.30 AM</span>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item sender mb-1">
                        <p>sed quia consequuntur magni dolores</p>
                    </div>
                    <!-- item @e -->
                    <!-- item @s -->
                    <div class="message-item sender">
                        <p>nisi ut aliquid ex ea commodi consequatur? <br> Quis autem vel eum iure reprehenderit qui in
                            ea</p>
                        <span>Wednesday, December 23th, 2020 at 4.30 AM</span>
                    </div>
                    <!-- item @e --> 
                </div>
                <!-- messages @e -->
            </div>
            <!-- main chart room @e -->

            <!-- message send box @s -->
            <div class="message-send-box">
                <div class="form-group">
                    <textarea rows="3" placeholder="type here..." class="form-control"></textarea>
                </div>
                <div class="file-attach-bttns">
                    <a href="#" class="bttn"><i class="fas fa-paper-plane"></i> SEND</a>
                    <a href="#"><i class="fa-solid fa-face-smile"></i></a>
                    <a href="#"><i class="fa-solid fa-paperclip"></i></a>
                </div>
            </div>
            <!-- message send box @e -->
        </div>
        <!-- chat-main-body box @e -->
    </div>
    <!-- message box @e -->
</section>

</main>
{{-- ==== Review list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}