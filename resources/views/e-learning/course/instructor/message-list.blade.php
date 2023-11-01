@extends('layouts.latest.instructor')
@section('title') Messsages List @endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/message.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
    {{-- ==== message list page @S ==== --}}
    <main class="message-list-page-wrap student-messages-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="messages-box">
                        <div class="chat-person-list-box">
                            <div class="title">
                                <h1>Messages <span>({{ count($highLightMessages) }})</span></h1>
                            </div>
                            <div class="search">

                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search" class="form-control">
                            </div>

                            <div class="person-tab-body"> 
                                    <a href="#">
                                        <div class="media">
                                            <div class="avatar">
                                                <img src="{{ asset('latest/assets/images/update-5.png') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <i class="fas fa-circle"></i>
                                            </div>

                                            <div class="media-body">
                                                <div class="name">
                                                    <h5>Katherine Moss</h5>
                                                    <span>12m</span>
                                                </div>
                                                <p>You: Sure thing, I’ll have a look today.</p>
                                            </div>
                                        </div>
                                    </a> 
                                    <a href="#">
                                        <div class="media">
                                            <div class="avatar">
                                                <img src="{{ asset('latest/assets/images/update-2.png') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <i class="fas fa-circle"></i>
                                            </div>

                                            <div class="media-body">
                                                <div class="name">
                                                    <h5>Katherine Moss</h5>
                                                    <span>12m</span>
                                                </div>
                                                <p>You: Sure thing, I’ll have a look today.</p>
                                            </div>
                                        </div>
                                    </a> 
                                    <a href="#">
                                        <div class="media">
                                            <div class="avatar">
                                                <img src="{{ asset('latest/assets/images/update-3.png') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <i class="fas fa-circle"></i>
                                            </div>

                                            <div class="media-body">
                                                <div class="name">
                                                    <h5>Katherine Moss</h5>
                                                    <span>12m</span>
                                                </div>
                                                <p>You: Sure thing, I’ll have a look today.</p>
                                            </div>
                                        </div>
                                    </a> 
                                    <a href="#">
                                        <div class="media">
                                            <div class="avatar">
                                                <img src="{{ asset('latest/assets/images/update-4.png') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <i class="fas fa-circle"></i>
                                            </div>

                                            <div class="media-body">
                                                <div class="name">
                                                    <h5>Katherine Moss</h5>
                                                    <span>12m</span>
                                                </div>
                                                <p>You: Sure thing, I’ll have a look today.</p>
                                            </div>
                                        </div>
                                    </a> 
                                    <a href="#">
                                        <div class="media">
                                            <div class="avatar">
                                                <img src="{{ asset('latest/assets/images/update-5.png') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <i class="fas fa-circle"></i>
                                            </div>

                                            <div class="media-body">
                                                <div class="name">
                                                    <h5>Katherine Moss</h5>
                                                    <span>12m</span>
                                                </div>
                                                <p>You: Sure thing, I’ll have a look today.</p>
                                            </div>
                                        </div>
                                    </a> 
                            </div>
                        </div> 
                            <div class="chat-main-body-box"> 
                                    <div class="chat-room-head"> 
                                        <div class="media">
                                            <img src="{{ asset('latest/assets/images/avatar.png') }}" alt="Avatar" class="img-fluid">

                                            <div class="media-body">
                                                <h5>Katherine Moss</h5>
                                                <p>@kathy</p>
                                            </div>
                                            <a href="#" class="common-bttn">View Profile</a>
                                        </div> 
                                    </div>

                                    <div class="main-chat-room">
                                        <div class="chat-messages-box">

                                            <div class="reciver message-item">
                                                    <p>Thanks Olivia! Almost there. I’ll work on making those changes you suggested and will shoot it over.</p>
                                                    <span>Thursday 10:16am</span>
                                            </div>
                                            <br>
                                            <div class="sender message-item bg-primary">
                                                    <p class="text-white">Hey Olivia, I’ve finished with the requirements doc! I made some notes in the gdoc as well for Phoenix to look over.</p>
                                                    <span class="text-white">Thursday 10:16am</span>
                                            </div>
                                            <br>
                                            <div class="reciver message-item">
                                                    <p>Thanks Olivia! Almost there. I’ll work on making those changes you suggested and will shoot it over.</p>
                                                    <span>Thursday 10:16am</span>
                                            </div>
                                            <br>
                                            <div class="sender message-item bg-primary">
                                                    <p class="text-white">Hey Olivia, I’ve finished with the requirements doc! I made some notes in the gdoc as well for Phoenix to look over.</p>
                                                    <span class="text-white">Thursday 10:16am</span>
                                            </div>
                                            <br>

                                        </div>
                                    </div>

                                    <form id="send" method="POST"
                                        action=""> 

                                        <div class="message-send-box">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Send a message"
                                                    name="message">
                                            </div>
                                            <div class="file-attach-bttns">
                                                <button type="submit" style="display: none;"></button>
                                                <button class="btn btn-prm">
                                                    <i class="bi bi-envelope"></i> Send
                                                </button>
                                            </div>
                                        </div>
                                    </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        {{-- ==== message list page @E ==== --}}
    @endsection
    {{-- page content @E --}}
