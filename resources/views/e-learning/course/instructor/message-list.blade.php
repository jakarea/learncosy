@extends('layouts.latest.instructor')
@section('title') Messsages Page @endsection

{{-- page style @S --}}
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('latest/assets/admin-css/message.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<style>
    .message-list-page-wrap {
        font-family: 'Poppins', sans-serif !important;
    }
</style>
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
                    {{-- leftbar side start --}}
                    <div class="chat-person-list-box">
                        {{--  title --}}
                        <div class="title">
                            <h1>Messages <span>40</span></h1>
                            <a href="#"><img src="{{asset('latest/assets/images/icons/m-user.svg')}}" alt="ic"
                                    class="img-fluid"> Create Group</a>
                        </div>
                        {{--  title --}}
                        {{-- chat filter --}}
                        <div class="header-filter">
                            <div class="search">
                                <img src="{{asset('latest/assets/images/icons/search-m.svg')}}" alt="ic"
                                    class="img-fluid">
                                <input type="text" placeholder="Search" class="form-control">
                            </div>
                            <div class="chat-filter">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{asset('latest/assets/images/icons/filter-2.svg')}}" alt="ic"
                                            class="img-fluid"> All Chat
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item active" href="#">All Chat</a></li>
                                        <li><a class="dropdown-item" href="#">Groups</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- chat filter --}}

                        {{-- leftbar person list start --}}
                        <div class="person-tab-body">
                            {{-- sidebar single person start --}}
                            <div class="single-person">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/update-5.png') }}" alt="Avatar"
                                            class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    
                                    <div class="media-body">
                                        <div class="name">
                                            <a href="#" class="name">Katherine Moss</a>
                                        </div>
                                        <p>You: Sure thing, I’ll have a l.. <span>12m</span></p>
                                    </div>
                                    {{-- action --}}
                                    <div class="dropdown">
                                        <a class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                      
                                        <ul class="dropdown-menu">
                                          <li>
                                            <a class="dropdown-item" href="#">
                                                <img src="{{ asset('latest/assets/images/icons/messages/trash.svg') }}" alt="ic" class="img-fluid"> Delete chat
                                            </a>
                                        </li>
                                          <li>
                                            <a class="dropdown-item" href="#">
                                                <img src="{{ asset('latest/assets/images/icons/messages/users.svg') }}" alt="ic" class="img-fluid"> Create group with Katherine
                                            </a>
                                        </li>
                                          <li>
                                            <a class="dropdown-item" href="#">
                                                <img src="{{ asset('latest/assets/images/icons/messages/mail-open.svg') }}" alt="ic" class="img-fluid"> Mark as unread
                                            </a>
                                        </li>
                                        </ul>
                                      </div>
                                    {{-- action --}}
                                </div>
                            </div>
                            {{-- sidebar single person end --}}
                        </div>
                        {{-- leftbar person list end --}}
                    </div>
                    {{-- leftbar side end --}}
                    
                    {{-- chat body right side start --}}
                    <div class="chat-main-body-box">
                        <div class="chat-room-head">
                            <div class="media">
                                <img src="{{ asset('latest/assets/images/avatar.png') }}" alt="Avatar"
                                    class="img-fluid">

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
                                    <p>Thanks Olivia! Almost there. I’ll work on making those changes you suggested and
                                        will shoot it over.</p>
                                    <span>Thursday 10:16am</span>
                                </div>
                                <br>
                                <div class="sender message-item bg-primary">
                                    <p class="text-white">Hey Olivia, I’ve finished with the requirements doc! I made
                                        some notes in the gdoc as well for Phoenix to look over.</p>
                                    <span class="text-white">Thursday 10:16am</span>
                                </div>
                                <br>
                                <div class="reciver message-item">
                                    <p>Thanks Olivia! Almost there. I’ll work on making those changes you suggested and
                                        will shoot it over.</p>
                                    <span>Thursday 10:16am</span>
                                </div>
                                <br>
                                <div class="sender message-item bg-primary">
                                    <p class="text-white">Hey Olivia, I’ve finished with the requirements doc! I made
                                        some notes in the gdoc as well for Phoenix to look over.</p>
                                    <span class="text-white">Thursday 10:16am</span>
                                </div>
                                <br>

                            </div>
                        </div>

                        <form id="send" method="POST" action="">

                            <div class="message-send-box">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Send a message" name="message">
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
                    {{-- chat body right side end --}}
                </div>
            </div>
        </div>
    </div>
</main>
{{-- ==== message list page @E ==== --}}
@endsection
{{-- page content @E --}}