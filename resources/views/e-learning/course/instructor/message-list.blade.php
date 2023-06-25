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
                <!-- <h1>Inbox <span>(2,456)</span></h1> -->
                <h1>Inbox </h1>

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
                        
                        @foreach ($highLightMessages as $message)
                           <a href="{{ route('message') }}?sender={{ $message[0]->user->id}}">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>

                                        <div class="media-body">
                                            <div class="name">
                                                <h5>{{$message[0]->user->name}}</h5> 
                                                <span>2m ago</span>
                                            </div>
                                            <p>{{$message[0]->message}}.</p>
                                        </div>
                                </div>
                            </a> 
                        @endforeach
                        
                       
                        <!-- person @e -->
                    </div>
                    <!-- all chat person @e -->
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
                        <h5>{{$senderInfo?  $senderInfo->name:""}}</h5>
                        <!-- <p>Last online at 04:45 AM</p> -->
                    </div>
                </div>
                <!-- chat person -->

                <!-- chat room head icons @s -->
                <!-- <div class="chat-room-head-icons">
                    <ul>
                        <li><a href="#"><i class="fas fa-video"></i></a></li>
                        <li><a href="#"><i class="fas fa-search"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-ellipsis-vertical"></i></a></li>
                    </ul>
                </div> -->
                <!-- chat room head icons @e -->
            </div>
            <!-- main chart room @s -->
            <div class="main-chat-room">
                <!-- chat date @s -->
                <!-- <div class="chat-top-date">
                    <span>Yesterday</span>
                </div> -->
                <!-- chat date @s -->
                <!-- messages @s -->

                
                <div class="chat-messages-box">
                    <!-- item @s -->
                    @foreach ($messages as $message)
                        <div class="{{ $message->user_id == $userId ? 'message-item  sender' : 'message-item reciver'}}">
                            <p>{{$message->message}}</p>
                            <span>{{$message->created_at}}</span>
                        </div>
                    @endforeach
                </div>
                <!-- messages @e -->
            </div>
            <!-- main chart room @e -->

            <!-- message send box @s -->
            <form id="send" method="POST" action="{{ route('message-send',['sender' => isset($senderInfo)?$senderInfo->id :'']) }}">
              @csrf

              <div class="message-send-box">
                    <div class="form-group">
                        <textarea rows="3" placeholder="type here..." class="form-control"  name="message"></textarea>
                    </div>
                    <div class="file-attach-bttns">
                        <button type="submit" style="display: none;"></button>
                        <button class="btn btn-primary">
                           <i class="bi bi-envelope"></i> Send
                        </button>
                    </div>
                </div>
            </form>
            <!-- <a href="" onclick="document.getElementById('send').submit();" class="bttn"><i class="fas fa-paper-plane"></i> SEND</a> -->

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